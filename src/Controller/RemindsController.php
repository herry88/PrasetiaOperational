<?php
namespace App\Controller;

use App\Controller\AppController;
use NumberFormatter;
use Cake\Event\Event;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;

/**
 * Reminds Controller
 *
 * @property \App\Model\Table\RemindsTable $Reminds
 */
class RemindsController extends AppController
{
	public function beforeFilter(Event $event)
    {
       parent::beforeFilter($event);
	   //echo ($this->Auth->user('id'));
	   
	   if ( $this->Auth->user('id') == 1 ){
		   $this->Auth->allow(['add','edit','index']);
	   } else {
		   $this->Auth->deny(['add','edit','delete']);
	   }
	  
    }
    /**
     * Index method
     *
     * @return void
     */
	 
/* 	public function index($id = null)
    {
        $this->paginate = [
            'conditions' => ['object_id >' => $id],
			'contain' => ['Objects', 'Items']
        ]; 
		
        //$this->set('reminds', $this->paginate($this->Reminds));
        $this->set('_serialize', ['reminds']);
    } */
	 
	 
	public function dashboard()
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        
        $objects = $this->Reminds->Objects->find('all');
        $types = $this->Reminds->Objects->Types->find('all');
        //$objects = $this->Reminds->Objects->find()->where(['state' => 1]);
        $objects1 = $this->Reminds->Objects->find('all')->where(['state' => 1]);

        $items = $this->Reminds->Items->find('all', ['limit' => 200]);
        
		//$query = $this->Reminds->find('all')->where(['object_id' => $id]);
		//$this->set('reminds', $this->paginate($query));
		$thismonth = date('m');
        $thisyear = date('Y');
        $thisdate = date('Y-m-d');

        $reminds = $this->Reminds->find('all')->where(['YEAR(deadline) <=' => $thisyear])
                                         ->andwhere(['Objects.state' => 1])
                                         ->andwhere(['Reminds.state' => 0])
                                         ->contain(['Objects'])
                                         ->order(['deadline' =>'ASC']);
			if ($this->Auth->user('id')==2) {						 
				$reminds = $this->Reminds->find('all')->where(['YEAR(deadline) <=' => $thisyear])
                                         ->andwhere(['Objects.state' => 1])
										 ->andwhere(['Objects.departemen_id' => 8])
                                         ->andwhere(['Reminds.state' => 0])
                                         ->contain(['Objects'])
                                         ->order(['deadline' =>'ASC']);
				}
			elseif ($this->Auth->user('id')==1){
				$reminds = $this->Reminds->find('all')->where(['YEAR(deadline) <=' => $thisyear])
                                         ->andwhere(['Objects.state' => 1])
                                         ->andwhere(['Reminds.state' => 0])
                                         ->contain(['Objects'])
                                         ->order(['deadline' =>'ASC']);
				}
					 
       $donuts = $this->Reminds->find('all')->select(['Items.name', 'total' => 'count(Reminds.id)'])
                                           ->where(['YEAR(deadline) <=' => $thisyear])
                                           ->andwhere(['Objects.state' => 1])
                                           ->andwhere(['Reminds.state' => 0])
                                           ->contain(['Items','Objects'])
                                           ->group('reminds.item_id')
                                           ->order(['deadline' =>'ASC']);

       $bars = $this->Reminds->find('all')->select(['Objects.type_id','Reminds.item_id', 'total' => 'count(Objects.id)'])
                                           ->where(['YEAR(deadline) <=' => $thisyear])
                                           ->andwhere(['Objects.state' => 1])
                                           ->andwhere(['Reminds.state' => 0])
                                           ->contain(['Items','Objects','Objects.Types'])
                                           ->group('objects.type_id')
                                           ->group('reminds.item_id')
                                           ->order(['Objects.type_id' =>'ASC','Reminds.item_id' => 'ASC']);
	
        $barGroups = null;
        foreach ($bars as $bar) {
            $barGroups[$bar->object->type_id][$bar->item_id] = $bar->total;
        }

        // $barGroups = $this->Reminds->find('all')
        // $barDataGroups = $this->Reminds->find('all')->leftJoinWith($typeGroups);

        $this->set(compact( 'objects', 'items', 'reminds', 'types','donuts','barGroups'));
		//$this->set('reminds', $this->paginate($this->Reminds));
        //$this->set('_serialize', ['reminds']);
    }

	public function printout($id = null)
    {
        /* $this->paginate = [
            'conditions' => ['object_id >' => $id],
			'contain' => ['Objects', 'Items']
        ]; */

        $this->viewBuilder()->setLayout('printout-layout');
        
        $objects = $this->Reminds->Objects->get($id);
        $items = $this->Reminds->Items->find('all', ['limit' => 200]);
        
		//$query = $this->Reminds->find('all')->where(['object_id' => $id]);
		//$this->set('reminds', $this->paginate($query));
		
		$reminds = $this->Reminds->find()->where(['object_id' => $id]);
		
        $this->set(compact( 'objects', 'items', 'reminds'));
		//$this->set('reminds', $this->paginate($this->Reminds));
        //$this->set('_serialize', ['reminds']);
    }

    public function printdetail($id = null)
    {
        //$cars = $this->Reminds->Objects->get($id);
        $cars = $this->Reminds->Objects->get($id,['contain' => ['Types']]);
        $reminds = $this->Reminds->find()->where(['object_id' => $id]);
        $items = $this->Reminds->Items->find('all',['limit' => 200]);

        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="CarReminderHistoryReport.xlsx"');
        header('Cache-Control: max-age=0');

        $getActiveSheet = $objPHPExcel->getActiveSheet();

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
        $styleCenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $styleRight = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            ),
        );

        $getActiveSheet->getStyle('B1')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B2')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B8')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B9')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E8')->applyFromArray($styleThinBlackBorderOutline);

        $getActiveSheet->getStyle('A12:M12')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A12:M12')->applyFromArray($styleCenter);
        
        $getActiveSheet->getColumnDimension('A')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('B')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('C')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('D')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('E')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('F')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('G')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('H')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('I')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('J')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('K')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('L')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('M')->setAutoSize(true);

        $getActiveSheet->getStyle('A1:A2')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );

        $getActiveSheet->setCellValue('A1', 'Type:');
        $getActiveSheet->setCellValue('A2', 'Print Date:');
        $getActiveSheet->setCellValue('B1', 'Car');
        $getActiveSheet->setCellValue('B2', date("d M Y"));
        
        $getActiveSheet->getStyle('A4')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A4', 'Master Data:');

        $getActiveSheet->getStyle('A5:A9')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('A5', 'Plat:');
        $getActiveSheet->setCellValue('A6', 'Name:');
        $getActiveSheet->setCellValue('A7', 'Status:');
        $getActiveSheet->setCellValue('A8', 'PIC:');
        $getActiveSheet->setCellValue('A9', 'Telp:');

        $getActiveSheet->setCellValue('B5', $cars->plat);
        $getActiveSheet->setCellValue('B6', $cars->name);
        $getActiveSheet->setCellValue('B7', ($cars->state == 1)? 'Active' : 'Non Active');
        $getActiveSheet->setCellValue('B8', $cars->PIC);
        $getActiveSheet->setCellValue('B9', $cars->telp);

        $getActiveSheet->getStyle('D5:D8')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('D5', 'Location:');
        $getActiveSheet->setCellValue('D6', 'Coordinator:');
        $getActiveSheet->setCellValue('D7', 'Address:');
        $getActiveSheet->setCellValue('D8', 'Note:');

        $getActiveSheet->setCellValue('E5', $cars->location);
        $getActiveSheet->setCellValue('E6', $cars->coordinator);
        $getActiveSheet->setCellValue('E7', $cars->address);
        $getActiveSheet->setCellValue('E8', $cars->note);

         $getActiveSheet->getStyle('A11')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A11', 'Reminder:');

        $getActiveSheet->getStyle('A12:M12')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A12:M12')->applyFromArray(
            array(
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFA0A0A0'
                        )
                    )
                )
            );

        $getActiveSheet->freezePane('A13');
        $getActiveSheet->setCellValue('A12', 'Deadline');
        $getActiveSheet->setCellValue('B12', 'Schedule Next');
        $getActiveSheet->setCellValue('C12', 'Status');
        $getActiveSheet->setCellValue('D12', 'Item');
        $getActiveSheet->setCellValue('E12', 'Budget');
        $getActiveSheet->setCellValue('F12', 'Real');
        $getActiveSheet->setCellValue('G12', 'KM Actual');
        $getActiveSheet->setCellValue('H12', 'KM Service');
        $getActiveSheet->setCellValue('I12', 'Problem');
        $getActiveSheet->setCellValue('J12', 'Counter Measure');
        $getActiveSheet->setCellValue('K12', 'Service Location');
        $getActiveSheet->setCellValue('L12', 'Vendor');
        $getActiveSheet->setCellValue('M12', 'Note');

        $i=13;
        foreach ($reminds as $remind) :
            $getActiveSheet->setCellValue('A'.$i, date_format($remind->deadline,"d M Y"));
            $getActiveSheet->setCellValue('B'.$i, date_format($remind->next,"d M Y"));
            $getActiveSheet->setCellValue('C'.$i, ($remind->state == 1)? 'Done' : 'Not Yet');
            foreach ($items as $item): 
                if ($item->id == $remind->item_id) {
                    $item_name = $item->name;
                }
            endforeach;
            $getActiveSheet->setCellValue('D'.$i, $item_name);
            $getActiveSheet->setCellValue('E'.$i, number_format($remind->price_est,2));
            $getActiveSheet->setCellValue('F'.$i, number_format($remind->price_act,2));
            $getActiveSheet->setCellValue('G'.$i, $remind->km_actual);
            $getActiveSheet->setCellValue('H'.$i, $remind->km_service);
            $getActiveSheet->setCellValue('I'.$i, $remind->sebelum_service);
            $getActiveSheet->setCellValue('J'.$i, $remind->tindakan_service);
            $getActiveSheet->setCellValue('K'.$i, $remind->nama_bengkel);
            $getActiveSheet->setCellValue('L'.$i, $remind->vendor);
            $getActiveSheet->setCellValue('M'.$i, $remind->note);

            $i++;
        endforeach;

        $getActiveSheet->getStyle('A13:M'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Car');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function printdetailmotor($id = null)
    {
        //$cars = $this->Reminds->Objects->get($id);
        $cars = $this->Reminds->Objects->get($id,['contain' => ['Types']]);
        $reminds = $this->Reminds->find()->where(['object_id' => $id]);
        $items = $this->Reminds->Items->find('all',['limit' => 200]);

        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="MotorCycleReminderHistoryReport.xlsx"');
        header('Cache-Control: max-age=0');

        $getActiveSheet = $objPHPExcel->getActiveSheet();

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
        $styleCenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $styleRight = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            ),
        );


        $getActiveSheet->getStyle('B1')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B2')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B8')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B9')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E8')->applyFromArray($styleThinBlackBorderOutline);

        $getActiveSheet->getStyle('A12:M12')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A12:M12')->applyFromArray($styleCenter);
        
        $getActiveSheet->getColumnDimension('A')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('B')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('C')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('D')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('E')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('F')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('G')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('H')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('I')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('J')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('K')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('L')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('M')->setAutoSize(true);

        $getActiveSheet->getStyle('A1:A2')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );

        $getActiveSheet->setCellValue('A1', 'Type:');
        $getActiveSheet->setCellValue('A2', 'Print Date:');
        $getActiveSheet->setCellValue('B1', 'MotorCycle');
        $getActiveSheet->setCellValue('B2', date("d M Y"));
        
        $getActiveSheet->getStyle('A4')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A4', 'Master Data:');

        $getActiveSheet->getStyle('A5:A9')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('A5', 'Plat:');
        $getActiveSheet->setCellValue('A6', 'Name:');
        $getActiveSheet->setCellValue('A7', 'Status:');
        $getActiveSheet->setCellValue('A8', 'PIC:');
        $getActiveSheet->setCellValue('A9', 'Telp:');

        $getActiveSheet->setCellValue('B5', $cars->plat);
        $getActiveSheet->setCellValue('B6', $cars->name);
        $getActiveSheet->setCellValue('B7', ($cars->state == 1)? 'Active' : 'Non Active');
        $getActiveSheet->setCellValue('B8', $cars->PIC);
        $getActiveSheet->setCellValue('B9', $cars->telp);

        $getActiveSheet->getStyle('D5:D8')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('D5', 'Location:');
        $getActiveSheet->setCellValue('D6', 'Coordinator:');
        $getActiveSheet->setCellValue('D7', 'Address:');
        $getActiveSheet->setCellValue('D8', 'Note:');

        $getActiveSheet->setCellValue('E5', $cars->location);
        $getActiveSheet->setCellValue('E6', $cars->coordinator);
        $getActiveSheet->setCellValue('E7', $cars->address);
        $getActiveSheet->setCellValue('E8', $cars->note);

         $getActiveSheet->getStyle('A11')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A11', 'Reminder:');

        $getActiveSheet->getStyle('A12:M12')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A12:M12')->applyFromArray(
            array(
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFA0A0A0'
                        )
                    )
                )
            );

        $getActiveSheet->freezePane('A13');
        $getActiveSheet->setCellValue('A12', 'Deadline');
        $getActiveSheet->setCellValue('B12', 'Schedule Next');
        $getActiveSheet->setCellValue('C12', 'Status');
        $getActiveSheet->setCellValue('D12', 'Item');
        $getActiveSheet->setCellValue('E12', 'Budget');
        $getActiveSheet->setCellValue('F12', 'Real');
        $getActiveSheet->setCellValue('G12', 'KM Actual');
        $getActiveSheet->setCellValue('H12', 'KM Service');
        $getActiveSheet->setCellValue('I12', 'Problem');
        $getActiveSheet->setCellValue('J12', 'Counter Measure');
        $getActiveSheet->setCellValue('K12', 'Service Location');
        $getActiveSheet->setCellValue('L12', 'Vendor');
        $getActiveSheet->setCellValue('M12', 'Note');

        $i=13;
        foreach ($reminds as $remind) :
            $getActiveSheet->setCellValue('A'.$i, date_format($remind->deadline,"d M Y"));
            $getActiveSheet->setCellValue('B'.$i, date_format($remind->next,"d M Y"));
            $getActiveSheet->setCellValue('C'.$i, ($remind->state == 1)? 'Done' : 'Not Yet');
            foreach ($items as $item): 
                if ($item->id == $remind->item_id) {
                    $item_name = $item->name;
                }
            endforeach;
            $getActiveSheet->setCellValue('D'.$i, $item_name);
            $getActiveSheet->setCellValue('E'.$i, number_format($remind->price_est,2));
            $getActiveSheet->setCellValue('F'.$i, number_format($remind->price_act,2));
            $getActiveSheet->setCellValue('G'.$i, $remind->km_actual);
            $getActiveSheet->setCellValue('H'.$i, $remind->km_service);
            $getActiveSheet->setCellValue('I'.$i, $remind->sebelum_service);
            $getActiveSheet->setCellValue('J'.$i, $remind->tindakan_service);
            $getActiveSheet->setCellValue('K'.$i, $remind->nama_bengkel);
            $getActiveSheet->setCellValue('L'.$i, $remind->vendor);
            $getActiveSheet->setCellValue('M'.$i, $remind->note);

            $i++;
        endforeach;

        $getActiveSheet->getStyle('A13:M'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('MotorCycle');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }    
	 
    public function printdetailbasecamp($id = null)
    {
        //$cars = $this->Reminds->Objects->get($id);
        $cars = $this->Reminds->Objects->get($id,['contain' => ['Types']]);
        $reminds = $this->Reminds->find()->where(['object_id' => $id]);
        $items = $this->Reminds->Items->find('all',['limit' => 200]);

        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="BasecampReminderHistoryReport.xlsx"');
        header('Cache-Control: max-age=0');

        $getActiveSheet = $objPHPExcel->getActiveSheet();

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
        $styleCenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $styleRight = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            ),
        );


        $getActiveSheet->getStyle('B1')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B2')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B8')->applyFromArray($styleThinBlackBorderOutline);
        //$getActiveSheet->getStyle('B9')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E7')->applyFromArray($styleThinBlackBorderOutline);
        //$getActiveSheet->getStyle('E8')->applyFromArray($styleThinBlackBorderOutline);

        $getActiveSheet->getStyle('A11:G11')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A11:G11')->applyFromArray($styleCenter);
        
        $getActiveSheet->getColumnDimension('A')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('B')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('C')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('D')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('E')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('F')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('G')->setAutoSize(true);
        
        $getActiveSheet->getStyle('A1:A2')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );

        $getActiveSheet->setCellValue('A1', 'Type:');
        $getActiveSheet->setCellValue('A2', 'Print Date:');
        $getActiveSheet->setCellValue('B1', 'Basecamp');
        $getActiveSheet->setCellValue('B2', date("d M Y"));
        
        $getActiveSheet->getStyle('A4')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A4', 'Master Data:');

        $getActiveSheet->getStyle('A5:A8')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('A5', 'Name:');
        $getActiveSheet->setCellValue('A6', 'Status:');
        $getActiveSheet->setCellValue('A7', 'PIC:');
        $getActiveSheet->setCellValue('A8', 'Telp:');
        //$getActiveSheet->setCellValue('A9', 'Telp:');

        $getActiveSheet->setCellValue('B5', $cars->name);
        $getActiveSheet->setCellValue('B6', ($cars->state == 1)? 'Active' : 'Non Active');
        $getActiveSheet->setCellValue('B7', $cars->PIC);
        $getActiveSheet->setCellValue('B8', $cars->telp);
        //$getActiveSheet->setCellValue('B9', $cars->telp);

        $getActiveSheet->getStyle('D5:D7')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('D5', 'Location:');
        $getActiveSheet->setCellValue('D6', 'Address:');
        $getActiveSheet->setCellValue('D7', 'Note:');
        //$getActiveSheet->setCellValue('D8', 'Note:');

        $getActiveSheet->setCellValue('E5', $cars->location);
        $getActiveSheet->setCellValue('E6', $cars->address);
        $getActiveSheet->setCellValue('E7', $cars->note);
        //$getActiveSheet->setCellValue('E8', $cars->note);

         $getActiveSheet->getStyle('A10')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A10', 'Reminder:');

        $getActiveSheet->getStyle('A11:G11')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A11:G11')->applyFromArray(
            array(
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFA0A0A0'
                        )
                    )
                )
            );

        $getActiveSheet->freezePane('A12');
        $getActiveSheet->setCellValue('A11', 'Deadline');
        $getActiveSheet->setCellValue('B11', 'Schedule Next');
        $getActiveSheet->setCellValue('C11', 'Status');
        $getActiveSheet->setCellValue('D11', 'Item');
        $getActiveSheet->setCellValue('E11', 'Budget');
        $getActiveSheet->setCellValue('F11', 'Real');
        $getActiveSheet->setCellValue('G11', 'Note');

        $i=12;
        foreach ($reminds as $remind) :
            $getActiveSheet->setCellValue('A'.$i, date_format($remind->deadline,"d M Y"));
            $getActiveSheet->setCellValue('B'.$i, date_format($remind->next,"d M Y"));
            $getActiveSheet->setCellValue('C'.$i, ($remind->state == 1)? 'Done' : 'Not Yet');
            foreach ($items as $item): 
                if ($item->id == $remind->item_id) {
                    $item_name = $item->name;
                }
            endforeach;
            $getActiveSheet->setCellValue('D'.$i, $item_name);
            $getActiveSheet->setCellValue('E'.$i, number_format($remind->price_est,2));
            $getActiveSheet->setCellValue('F'.$i, number_format($remind->price_act,2));
            $getActiveSheet->setCellValue('G'.$i, $remind->note);

            $i++;
        endforeach;

        $getActiveSheet->getStyle('A12:G'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Basecamp');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function printdetailoffice($id = null)
    {
        //$cars = $this->Reminds->Objects->get($id);
        $cars = $this->Reminds->Objects->get($id,['contain' => ['Types']]);
        $reminds = $this->Reminds->find()->where(['object_id' => $id]);
        $items = $this->Reminds->Items->find('all',['limit' => 200]);

        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="OfficeReminderHistoryReport.xlsx"');
        header('Cache-Control: max-age=0');

        $getActiveSheet = $objPHPExcel->getActiveSheet();

        $styleThinBlackBorderOutline = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
        );
        $styleCenter = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $styleRight = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            ),
        );


        $getActiveSheet->getStyle('B1')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B2')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B7')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('B8')->applyFromArray($styleThinBlackBorderOutline);
        //$getActiveSheet->getStyle('B9')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E6')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('E7')->applyFromArray($styleThinBlackBorderOutline);
        //$getActiveSheet->getStyle('E8')->applyFromArray($styleThinBlackBorderOutline);

        $getActiveSheet->getStyle('A11:H11')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A11:H11')->applyFromArray($styleCenter);
        
        $getActiveSheet->getColumnDimension('A')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('B')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('C')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('D')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('E')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('F')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('G')->setAutoSize(true);
        $getActiveSheet->getColumnDimension('H')->setAutoSize(true);
        
        $getActiveSheet->getStyle('A1:A2')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );

        $getActiveSheet->setCellValue('A1', 'Type:');
        $getActiveSheet->setCellValue('A2', 'Print Date:');
        $getActiveSheet->setCellValue('B1', 'Office');
        $getActiveSheet->setCellValue('B2', date("d M Y"));
        
        $getActiveSheet->getStyle('A4')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A4', 'Master Data:');

        $getActiveSheet->getStyle('A5:A8')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('A5', 'Name:');
        $getActiveSheet->setCellValue('A6', 'Status:');
        $getActiveSheet->setCellValue('A7', 'PIC:');
        $getActiveSheet->setCellValue('A8', 'Telp:');
        //$getActiveSheet->setCellValue('A9', 'Telp:');

        $getActiveSheet->setCellValue('B5', $cars->name);
        $getActiveSheet->setCellValue('B6', ($cars->state == 1)? 'Active' : 'Non Active');
        $getActiveSheet->setCellValue('B7', $cars->PIC);
        $getActiveSheet->setCellValue('B8', $cars->telp);
        //$getActiveSheet->setCellValue('B9', $cars->telp);

        $getActiveSheet->getStyle('D5:D7')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->setCellValue('D5', 'Location:');
        $getActiveSheet->setCellValue('D6', 'Address:');
        $getActiveSheet->setCellValue('D7', 'Note:');
        //$getActiveSheet->setCellValue('D8', 'Note:');

        $getActiveSheet->setCellValue('E5', $cars->location);
        $getActiveSheet->setCellValue('E6', $cars->address);
        $getActiveSheet->setCellValue('E7', $cars->note);
        //$getActiveSheet->setCellValue('E8', $cars->note);

         $getActiveSheet->getStyle('A10')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true,
                            'underline' => true,
                            'size' => 16
                        )
                    )
            );
        $getActiveSheet->setCellValue('A10', 'Reminder:');

        $getActiveSheet->getStyle('A11:H11')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A11:H11')->applyFromArray(
            array(
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFA0A0A0'
                        )
                    )
                )
            );

        $getActiveSheet->freezePane('A12');
        $getActiveSheet->setCellValue('A11', 'Deadline');
        $getActiveSheet->setCellValue('B11', 'Schedule Next');
        $getActiveSheet->setCellValue('C11', 'Status');
        $getActiveSheet->setCellValue('D11', 'Item');
        $getActiveSheet->setCellValue('E11', 'Budget');
        $getActiveSheet->setCellValue('F11', 'Real');
        $getActiveSheet->setCellValue('G11', 'Vendor');
        $getActiveSheet->setCellValue('H11', 'Note');

        $i=12;
        foreach ($reminds as $remind) :
            $getActiveSheet->setCellValue('A'.$i, date_format($remind->deadline,"d M Y"));
            $getActiveSheet->setCellValue('B'.$i, date_format($remind->next,"d M Y"));
            $getActiveSheet->setCellValue('C'.$i, ($remind->state == 1)? 'Done' : 'Not Yet');
            foreach ($items as $item): 
                if ($item->id == $remind->item_id) {
                    $item_name = $item->name;
                }
            endforeach;
            $getActiveSheet->setCellValue('D'.$i, $item_name);
            $getActiveSheet->setCellValue('E'.$i, number_format($remind->price_est,2));
            $getActiveSheet->setCellValue('F'.$i, number_format($remind->price_act,2));
            $getActiveSheet->setCellValue('G'.$i, $remind->vendor);
            $getActiveSheet->setCellValue('H'.$i, $remind->note);

            $i++;
        endforeach;

        $getActiveSheet->getStyle('A12:H'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Office');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function index($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        
        $object = $this->Reminds->Objects->get($id,['contain' => ['Types']]);

        //$objects = $this->Reminds->Objects->get($id,['contain' => ['Types']]);

        //$items = $this->Reminds->Items->find('all', ['limit' => 200]);
		
		$reminds = $this->Reminds->find()->where(['object_id' => $id])
                                         ->contain(['Items']);
		
        $userlog = $this->Auth->user('id');
		
		$this->set(compact( 'object', 'reminds', 'userlog'));
		//$this->set('reminds', $this->paginate($this->Reminds));
        //$this->set('_serialize', ['reminds']);
    }

    /**
     * View method
     * @param string|null $id Remind id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $remind = $this->Reminds->get($id, [
            'contain' => ['Objects', 'Items']
        ]);
	    $objects = $this->Reminds->Objects->find('all', ['limit' => 200]);
        $items = $this->Reminds->Items->find('all', ['limit' => 200]);
        $remind_photo = $this->Reminds->RemindPhotos->find()->where(['remind_id' => $id]);
        $remind_id = $id;
        $this->set(compact( 'objects', 'items', 'remind_photo','remind_id'));
        $this->set('remind', $remind);
        $this->set('_serialize', ['remind']);	
		//pr($items);
    }
	

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $remind = $this->Reminds->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['object_id']=$id;
			//pr($this->request->data);
			//exit();
            $remind = $this->Reminds->patchEntity($remind, $this->request->data);

            $fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL );

            $remind->deadline = $this->convertDate($this->request->data['deadline']);
            $remind->next = $this->convertDate($this->request->data['next']);
            $remind->price_est = $fmt->parse($this->request->data['price_est']);
			$remind->price_act = $fmt->parse($this->request->data['price_act']);

            if ($this->Reminds->save($remind)) {
                $this->Flash->success(__('The remind has been saved.'));
                return $this->redirect(['action' => 'index',$id]);
            } else {
                $this->Flash->error(__('The remind could not be saved. Please, try again.'));
            }
        }
		
		$object_selects = $this->Reminds->Objects->get($id);
        $objects = $this->Reminds->Objects->find('list', ['limit' => 200]);
        $items = $this->Reminds->Items->find('list', ['limit' => 200]);
        $this->set(compact('remind', 'items','object_selects'));
        $this->set('_serialize', ['remind']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Remind id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$objects_id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $remind = $this->Reminds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remind = $this->Reminds->patchEntity($remind, $this->request->data);
			
			$fmt = new NumberFormatter('en_US', NumberFormatter::DECIMAL );

            $remind->deadline = $this->convertDate($this->request->data['deadline']);
            $remind->next = $this->convertDate($this->request->data['next']);
            $remind->price_est = $fmt->parse($this->request->data['price_est']);
			$remind->price_act = $fmt->parse($this->request->data['price_act']);
			
            if ($this->Reminds->save($remind)) {
                $this->Flash->success(__('The remind has been saved.'));
				$oid=$objects_id;
				return $this->redirect(['action' => 'index',$oid]);
            } else {
                $this->Flash->error(__('The remind could not be saved. Please, try again.'));
            }
        }
        $remind->deadline = $remind->deadline->format('d/m/Y');
        $remind->next = $remind->next->format('d/m/Y');

        $object_selects = $this->Reminds->Objects->get($objects_id);
        $objects = $this->Reminds->Objects->find('list', ['limit' => 200]);
        $items = $this->Reminds->Items->find('list', ['limit' => 200]);
        $this->set(compact('remind', 'objects', 'items','object_selects'));
        $this->set('_serialize', ['remind']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Remind id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $this->request->allowMethod(['post', 'delete']);
        $remind = $this->Reminds->get($id);
        if ($this->Reminds->delete($remind)) {
            $this->Flash->success(__('The remind has been deleted.'));
        } else {
            $this->Flash->error(__('The remind could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    private function convertDate($var){
        $data = explode('/',$var);
        return $data[2].'-'.$data[1].'-'.$data[0];
    }
}

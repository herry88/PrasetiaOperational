<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
/**
 * Objects Controller
 *
 * @property \App\Model\Table\ObjectsTable $Objects
 */
class ObjectsController extends AppController
{
	public function beforeFilter(Event $event)
    {
       parent::beforeFilter($event);
	   //echo ($this->Auth->user('id'));
	   
	   if ( $this->Auth->user('id') == 1 ){
		   $this->Auth->allow(['add','edit','index','view','delete','exportexcelcar','exportexcelmotorcycle','exportexcelbasecamp',
               'exportexceloffice','car','motorcycle','basecamp','office','addmotorcycle','addbasecamp','addoffice',
               'editmotorcycle','editbasecamp','editoffice']);
	   } else {
		   $this->Auth->deny(['add','edit','delete']);
	   }
	  
	  
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        

		$types = $this->Objects->Types->find('all');
        $cars = $this->Objects->find()->where(['Objects.type_id' => 1]);
        $motorcycles = $this->Objects->find()->where(['Objects.type_id' => 2]);
        $basecamps = $this->Objects->find()->where(['Objects.type_id' => 4]);
		
		$this->set(compact('types','cars','motorcycles','basecamps','companies'));
    }

    public function exportexcelcar()
    {
        $objects = $this->Objects->find()->where(['Objects.type_id' => 1]);
		$companies = $this->Objects->Companies->find('all');
        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="CarHistoryReport.xlsx"');
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

        $getActiveSheet->getStyle('A5:J5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A5:J5')->applyFromArray($styleCenter);
        
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

        $getActiveSheet->getStyle('A5:J5')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A5:J5')->applyFromArray(
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

        $getActiveSheet->freezePane('A6');
        $getActiveSheet->setCellValue('A5', 'Plat');
        $getActiveSheet->setCellValue('B5', 'Name');
        $getActiveSheet->setCellValue('C5', 'Status');
		$getActiveSheet->setCellValue('D5', 'Company');
        $getActiveSheet->setCellValue('E5', 'PIC');
        $getActiveSheet->setCellValue('F5', 'Telp');
        $getActiveSheet->setCellValue('G5', 'Coordinator');
        $getActiveSheet->setCellValue('H5', 'Location');
        $getActiveSheet->setCellValue('I5', 'Address');
        $getActiveSheet->setCellValue('J5', 'Note');
		
		
        $i=6;

        foreach ($objects as $object) :
            $getActiveSheet->setCellValue('A'.$i, $object->plat);
            $getActiveSheet->setCellValue('B'.$i, $object->name);
            $getActiveSheet->setCellValue('C'.$i, ($object->state == 1)? 'Active' : 'Non Active');
            $getActiveSheet->setCellValue('E'.$i, $object->PIC);
            $getActiveSheet->setCellValue('F'.$i, $object->telp);
            $getActiveSheet->setCellValue('G'.$i, $object->coordinator);
            $getActiveSheet->setCellValue('H'.$i, $object->location);
            $getActiveSheet->setCellValue('I'.$i, $object->address);
            $getActiveSheet->setCellValue('J'.$i, $object->note);
			
           foreach ($companies as $company) :  
				if ($company->id == $object->company_id){
					$vcompany = $company->name ;
				}
			endforeach;
                    			
            $getActiveSheet->setCellValue('D'.$i, $vcompany);
            $i++;
			
        endforeach;

        $getActiveSheet->getStyle('A6:J'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Car');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function exportexcelmotorcycle()
    {
        $objects = $this->Objects->find()->where(['Objects.type_id' => 2]); 
		$companies = $this->Objects->Companies->find('all');
		
        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="MotorCycleHistoryReport.xlsx"');
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

        $getActiveSheet->getStyle('A5:J5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A5:J5')->applyFromArray($styleCenter);
        
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

        $getActiveSheet->getStyle('A5:J5')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A5:J5')->applyFromArray(
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

        $getActiveSheet->freezePane('A6');
        $getActiveSheet->setCellValue('A5', 'Plat');
        $getActiveSheet->setCellValue('B5', 'Name');
        $getActiveSheet->setCellValue('C5', 'Status');
		$getActiveSheet->setCellValue('D5', 'Company');
        $getActiveSheet->setCellValue('E5', 'PIC');
        $getActiveSheet->setCellValue('F5', 'Telp');
        $getActiveSheet->setCellValue('G5', 'Coordinator');
        $getActiveSheet->setCellValue('H5', 'Location');
        $getActiveSheet->setCellValue('I5', 'Address');
        $getActiveSheet->setCellValue('J5', 'Note');
	

        $i=6;

        foreach ($objects as $object) :
            $getActiveSheet->setCellValue('A'.$i, $object->plat);
            $getActiveSheet->setCellValue('B'.$i, $object->name);
            $getActiveSheet->setCellValue('C'.$i, ($object->state == 1)? 'Active' : 'Non Active');
            $getActiveSheet->setCellValue('E'.$i, $object->PIC);
            $getActiveSheet->setCellValue('F'.$i, $object->telp);
            $getActiveSheet->setCellValue('G'.$i, $object->coordinator);
            $getActiveSheet->setCellValue('H'.$i, $object->location);
            $getActiveSheet->setCellValue('I'.$i, $object->address);
            $getActiveSheet->setCellValue('J'.$i, $object->note);
			 
			foreach ($companies as $company) :  
				if ($company->id == $object->company_id){
					$vcompany = $company->name ;
				}
			endforeach;
                    			
            $getActiveSheet->setCellValue('D'.$i, $vcompany);
            $i++;
        endforeach;

        $getActiveSheet->getStyle('A6:J'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('MotorCycle');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function exportexcelbasecamp()
    {
        $objects = $this->Objects->find()->where(['Objects.type_id' => 4]);
		$companies = $this->Objects->Companies->find('all');
        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="BasecampHistoryReport.xlsx"');
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

        $getActiveSheet->getStyle('A5:H5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A5:H5')->applyFromArray($styleCenter);
        
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

        $getActiveSheet->getStyle('A5:H5')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A5:H5')->applyFromArray(
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

        $getActiveSheet->freezePane('A6');
        $getActiveSheet->setCellValue('A5', 'Name');
        $getActiveSheet->setCellValue('B5', 'Status');
        $getActiveSheet->setCellValue('C5', 'PIC');
        $getActiveSheet->setCellValue('D5', 'Telp');
        $getActiveSheet->setCellValue('E5', 'Location');
		$getActiveSheet->setCellValue('F5', 'Company');
        $getActiveSheet->setCellValue('G5', 'Address');
        $getActiveSheet->setCellValue('H5', 'Note');

        $i=6;

        foreach ($objects as $object) :
            $getActiveSheet->setCellValue('A'.$i, $object->name);
            $getActiveSheet->setCellValue('B'.$i, ($object->state == 1)? 'Active' : 'Non Active');
            $getActiveSheet->setCellValue('C'.$i, $object->PIC);
            $getActiveSheet->setCellValue('D'.$i, $object->telp);
            $getActiveSheet->setCellValue('E'.$i, $object->location);
			foreach ($companies as $company) :  
				if ($company->id == $object->company_id){
					$vcompany = $company->name ;
				}
			endforeach;    			
            $getActiveSheet->setCellValue('F'.$i, $vcompany);
            $getActiveSheet->setCellValue('G'.$i, $object->address);
            $getActiveSheet->setCellValue('H'.$i, $object->note);
            	
            $i++;
        endforeach;

        $getActiveSheet->getStyle('A6:H'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Basecamp');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function exportexceloffice()
    {
        $objects = $this->Objects->find()->where(['Objects.type_id' => 5]);
		$companies = $this->Objects->Companies->find('all');
        $objPHPExcel = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="OfficeHistoryReport.xlsx"');
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

        $getActiveSheet->getStyle('A5:H5')->applyFromArray($styleThinBlackBorderOutline);
        $getActiveSheet->getStyle('A5:H5')->applyFromArray($styleCenter);
        
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

        $getActiveSheet->getStyle('A5:H5')->applyFromArray(
                array(
                    'font' => array(
                            'bold' => true
                        )
                    )
            );
        $getActiveSheet->getStyle('A5:H5')->applyFromArray(
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

        $getActiveSheet->freezePane('A6');
        $getActiveSheet->setCellValue('A5', 'Name');
        $getActiveSheet->setCellValue('B5', 'Status');
        $getActiveSheet->setCellValue('C5', 'PIC');
        $getActiveSheet->setCellValue('D5', 'Telp');
        $getActiveSheet->setCellValue('E5', 'Location');
        $getActiveSheet->setCellValue('F5', 'Company');
        $getActiveSheet->setCellValue('G5', 'Address');
		$getActiveSheet->setCellValue('H5', 'Note');

        $i=6;

        foreach ($objects as $object) :
            $getActiveSheet->setCellValue('A'.$i, $object->name);
            $getActiveSheet->setCellValue('B'.$i, ($object->state == 1)? 'Active' : 'Non Active');
            $getActiveSheet->setCellValue('C'.$i, $object->PIC);
            $getActiveSheet->setCellValue('D'.$i, $object->telp);
            $getActiveSheet->setCellValue('E'.$i, $object->location);
			
            foreach($companies as $company) :  
				if ($company->id == $object->company_id){
					$vcompany = $company->name ;
				}
			endforeach; 
   			$getActiveSheet->setCellValue('F'.$i, $vcompany);
			$getActiveSheet->setCellValue('G'.$i, $object->address);
            $getActiveSheet->setCellValue('H'.$i, $object->note);
			
            $i++;
        endforeach;

        $getActiveSheet->getStyle('A6:H'.($i-1))->applyFromArray($styleThinBlackBorderOutline);

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Office');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));

        $objWriter->save("php://output");

        return $this->redirect(['action' => 'index']);
    }

    public function car(){
        $this->viewBuilder()->setLayout('master-data-layout');
       // $cars = $this->Objects->find()->where(['Objects.type_id' => 1]);
		 if ($this->Auth->user('id')==2) {
			$cars = $this->Objects->find()->where(['Objects.type_id' => 1,'Objects.departemen_id' => 8]);
		 }
		 elseif ($this->Auth->user('id')==1){
			 $cars = $this->Objects->find()->where(['Objects.type_id' => 1]);
		 }

        $companies = $this->Objects->Companies->find('all');
		$userlog = $this->Auth->user('id');
        $this->set(compact('cars','userlog','companies'));
    }

    public function motorcycle(){
        $this->viewBuilder()->setLayout('master-data-layout');
        //$motorcycles = $this->Objects->find()->where(['Objects.type_id' => 2,]);
		 if ($this->Auth->user('id')==2) {
			$motorcycles = $this->Objects->find()->where(['Objects.type_id' => 2,'Objects.departemen_id' => 8]);
		 }
		 elseif ($this->Auth->user('id')==1){
			 $motorcycles = $this->Objects->find()->where(['Objects.type_id' => 2]);
		 }

        $companies = $this->Objects->Companies->find('all');
        $userlog = $this->Auth->user('id');
		$this->set(compact('motorcycles','userlog','companies'));
    }

    public function basecamp(){
        $this->viewBuilder()->setLayout('master-data-layout');
        //$basecamps = $this->Objects->find()->where(['Objects.type_id' => 4]);
		 if ($this->Auth->user('id')==2) {
			$basecamps = $this->Objects->find()->where(['Objects.type_id' => 4,'Objects.departemen_id' => 8])->contain(['Reminds']);
		 }
		 elseif ($this->Auth->user('id')==1){
			 $basecamps = $this->Objects->find()->where(['Objects.type_id' => 4])->contain(['Reminds']);
		 }
        // $reminds = $this->Reminds->find('all');
		$companies = $this->Objects->Companies->find('all');
		$userlog = $this->Auth->user('id');
        $this->set(compact('basecamps','userlog','companies'));
		
    }

	public function office(){
        $this->viewBuilder()->setLayout('master-data-layout');
        $offices = $this->Objects->find()->where(['Objects.type_id' => 5]);
		$companies = $this->Objects->Companies->find('all');
        $this->set(compact('offices','companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Object id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');
        
        $object = $this->Objects->get($id, [
            'contain' => ['Types', 'Reminds' => ['Items']]
        ]);
		$items = $this->Objects->Reminds->Items->find('all', ['limit' => 200]);
		
		$type4 = $this->Objects->find('all')->where(['type_id' => 4]);
		
        $this->set('object', $object);
        $this->set('_serialize', ['object']);
		$this->set(compact('items'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {
			//pr($this->request->data);
			//exit;
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The vehicle has been saved.'));
                return $this->redirect(['action' => 'car']);
            } else {
                $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 1]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }

    public function addmotorcycle()
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {
            //pr($this->request->data);
            //exit;
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The vehicle has been saved.'));
                return $this->redirect(['action' => 'motorcycle']);
            } else {
                $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 2]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }

	public function addbasecamp()
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {
			//pr($this->request->data);
			//exit;
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The basecamp has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The basecamp could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 4]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
		$this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }
	
	public function addoffice()
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {
			//pr($this->request->data);
			//exit;
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The office has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 5]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
		$this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }
	
    /**
     * Edit method
     *
     * @param string|null $id Object id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The vehicle has been saved.'));
                return $this->redirect(['action' => 'car']);
            } else {
                $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
            }
        }
        //$types = $this->Objects->Types->find('list', ['limit' => 200])->where(function($exp){return $exp->notEq('id',4);});
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 1]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }
	
    public function editmotorcycle($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The vehicle has been saved.'));
                return $this->redirect(['action' => 'motorcycle']);
            } else {
                $this->Flash->error(__('The vehicle could not be saved. Please, try again.'));
            }
        }
        //$types = $this->Objects->Types->find('list', ['limit' => 200])->where(function($exp){return $exp->notEq('id',4);});
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 2]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }

	public function editbasecamp($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The basecamp has been saved.'));
                return $this->redirect(['action' => 'basecamp']);
            } else {
                $this->Flash->error(__('The basecamp could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 4]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }
	
	public function editoffice($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $object = $this->Objects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->data);
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The office has been saved.'));
                return $this->redirect(['action' => 'office']);
            } else {
                $this->Flash->error(__('The office could not be saved. Please, try again.'));
            }
        }
        $types = $this->Objects->Types->find('list', ['limit' => 200])->where(['id' => 5]);
		$companies = $this->Objects->Companies->find('list', ['limit' => 200]);
        $this->set(compact('object', 'types','companies'));
        $this->set('_serialize', ['object']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Object id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->viewBuilder()->setLayout('master-data-layout');

        $this->request->allowMethod(['post', 'delete']);
        $object = $this->Objects->get($id);
        if ($this->Objects->delete($object)) {
            $this->Flash->success(__('The object has been deleted.'));
        } else {
            $this->Flash->error(__('The object could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

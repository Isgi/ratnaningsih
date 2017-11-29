<?php
/**
 * @author Achmad Solichin
 * @website http://achmatim.net
 * @email achmatim@gmail.com
 */
require_once BASEPATH.'../application/libraries/fpdf17/fpdf.php';

class FPDF_AutoWrapTable extends FPDF {
  	private $data_title;
  	private $data_content = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'A4',
  		'orientation'=>'P'
  	);

  	function __construct($data_content = array(), $data_title, $options = array()) {
    	parent::__construct();
    	$this->data_content = $data_content;
    	$this->data_title =$data_title;
    	$this->options = $options;
	}

	public function rptDetailData () {

		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;

		//header
		$this->SetFont("", "B", 10);
		$this->MultiCell(0, 9, 'LAPORAN ARUS KAS '.$this->data_title);
		$this->Cell(0, 1, " ", "B");
		$this->Ln(10);
		$this->SetFont("", "B", 10);
		$this->SetX($left); $this->Cell(0, 10, 'ARUS KAS '.$this->data_title, 0, 1,'C');
		$this->Ln(10);
		$this->SetFont("", "B", 10);
		$this->SetX($left); $this->Cell(0, 10, 'KB & TK RATNANINGSIH', 0, 1,'C');
		$this->Ln(10);

		$h = 13;
		$left = 40;
		$top = 80;
		#tableheader
		$this->SetFillColor(200,200,200);
		$left = $this->GetX();
		$this->Cell(20,$h,'NO',1,0,'L',true);
		$this->SetX($left += 20); $this->Cell(60, $h, 'TANGGAL', 1, 0, 'C',true);
		$this->SetX($left += 60); $this->Cell(210, $h, 'KETERANGAN', 1, 0, 'C',true);
    $this->SetX($left += 210); $this->Cell(70, $h, 'KODE', 1, 0, 'C',true);
    $this->SetX($left += 70); $this->Cell(90, $h, 'DEBIT', 1, 0, 'C',true);
		$this->SetX($left += 90); $this->Cell(90, $h, 'KREDIT', 1, 1, 'C',true);
		//$this->Ln(20);

		$this->SetFont('Arial','',9);
		$this->SetWidths(array(20,60,210,70,90,90));
		$this->SetAligns(array('C','C','L','C','C','R'));
		$no = 1; $this->SetFillColor(255);
    $jumlah_debit = 0;
    $jumlah_kredit = 0;
		foreach ($this->data_content as $data) {
      if ($data->transaksi_jenis) {
        if ($data->transaksi_jenis == 'pemasukan') {
          $jumlah_debit = $jumlah_debit + $data->nominal;
        } else {
          $jumlah_kredit = $jumlah_kredit + $data->nominal;
        }
      } else {
        if ($data->transaksi_jenis == 'pemasukan') {
          $jumlah_debit = $jumlah_debit + $data->nominal;
        } else {
          $jumlah_kredit = $jumlah_kredit + $data->nominal;
        }
      }

			$i = array(
				'no'=>$no++,
				'tgl_setoran' => date('d-M-Y', strtotime($data->tgl_setoran)),
				'keterangan' => ($data->nama.', '.$data->penyetor),
        'kode' => ($data->kode),
				'debit' => ($data->transaksi_jenis == 'pemasukan' ? $data->nominal : ''),
				'kredit' => ($data->transaksi_jenis == 'pengeluaran' ? $data->nominal : '')
			);
			$this->Row (
				array(
					$i['no'],
					$i['tgl_setoran'],
					$i['keterangan'],
					$i['kode'],
          $i['debit'],
					$i['kredit']
					)
				);
		}
    $this->Cell(10,20,'Keterangan :',0,1);
    $this->Cell(100,20,'Jumlah Debit ');
    $this->Cell(10,20,': Rp.'.$jumlah_debit.',-',0,1);
    $this->Cell(100,20,'Jumlah Kredit ');
    $this->Cell(10,20,': Rp.'.$jumlah_kredit.',-',0,1);

	}

	public function printPDF () {

		if ($this->options['paper_size'] == "A4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}

	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();

	    $this->rptDetailData();

	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}

  	 private $widths;
	   private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class


/* contoh penggunaan dengan data diambil dari database mysql
 *
 * 1. buatlah database di mysql
 * 2. buatlah tabel 'pegawai' dengan field: nip, nama, alamat, email dan website
 * 3. isikan beberapa contoh data ke tabel pegawai tersebut.
 *
 * */

#koneksi ke database (disederhanakan)

//pilihan
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data_content,$data_title, $options);
$tabel->printPDF();
?>

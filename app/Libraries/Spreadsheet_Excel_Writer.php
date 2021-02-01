<?php namespace App\Libraries;
class Spreadsheet_Excel_Writer{
  public $styles;
  public $sheets;
  public $debug;
	
  //~ function Spreadsheet_Excel_Writer(){
  public function __construct(){
    $this->styles=array();
    $this->sheets=array();
  }

  public function send( $filename ){
    header( 'Content-type: application/vnd.ms-excel' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
    header( 'Expires: 0' );
    header( 'Cache-Control: public, must-revalidate, post-check=0, pre-check=0' );
    header( "Pragma: hack" );
  }

  public function close(){
    $this->show();
  }

  public function &addWorksheet( $sheetname ){
    $id=count( $this->sheets );
    $sheetname=utf8_encode( mb_substr( $sheetname, 0, 31 ) );
    if( isset( $this->sheets[ $sheetname ] ) )
      $sheetname=mb_substr( '(' . $id . ')' . $sheetname, 0, 31 );
    $sheet=new ExcelWorksheet( $sheetname );
    $sheet->id=$id;
    $this->sheets[ $sheetname ]=&$sheet;
    return $sheet;
  }

  public function &addFormat(){
    $id=count( $this->styles );
    $style=new ExcelStyle();
    $style->id="s$id";
    $this->styles[]=&$style;
    return $style;
  }

  public function rowcolToCell( $row, $col ){
    return 'R' . ($row+1) . 'C' . ($col+1);
  }

  public function setVersion( $version ){
    // compatibilidad con PEAR
  }

  public function show(){
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?' . '>' . "\n";
    echo '<?mso-application progid="Excel.Sheet"?' . '>' . "\n";
    echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">' . "\n";
    echo '  <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">' . "\n";
    echo '    <Author>Talentus S.A</Author>' . "\n";
    echo '    <LastAuthor>Talentus S. A.</LastAuthor>' . "\n";
    echo '    <Created>' . date( "Y-m-d\\TH:i:s\\Z" ) . '</Created>' . "\n";
    echo '    <Version>11.9999</Version>' . "\n";
    echo '  </DocumentProperties>' . "\n";
    echo '  <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">' . "\n";
    echo '    <WindowHeight>12270</WindowHeight>' . "\n";
    echo '    <WindowWidth>18795</WindowWidth>' . "\n";
    echo '    <WindowTopX>120</WindowTopX>' . "\n";
    echo '    <WindowTopY>60</WindowTopY>' . "\n";
    echo '    <ProtectStructure>False</ProtectStructure>' . "\n";
    echo '    <ProtectWindows>False</ProtectWindows>' . "\n";
    echo '  </ExcelWorkbook>' . "\n";
    echo '  <Styles>' . "\n";
    echo '    <Style ss:ID="Default" ss:Name="Normal">' . "\n";
    echo '      <Alignment ss:Vertical="Bottom"/>' . "\n";
    echo '      <Borders/>' . "\n";
    echo '      <Font/>' . "\n";
    echo '      <Interior/>' . "\n";
    echo '      <NumberFormat/>' . "\n";
    echo '      <Protection/>' . "\n";
    echo '    </Style>' . "\n";

    foreach( $this->styles as $style ){
      $style->show();
    }

    echo '  </Styles>' . "\n";

    foreach( $this->sheets as $sheet ){
      $sheet->show();
    }
    echo '</Workbook>' . "\n";
  }
}

class ExcelStyle{
  public $font_name;
  public $color;
  public $bgcolor;
  public $size;
  public $bold;
  public $italic;
  public $underline;
  public $align;
  public $valign;
  public $border_left;
  public $border_top;
  public $border_right;
  public $border_bottom;
  public $wrap_text;
  public $number_format;

  //~ function ExcelStyle(){
  public function __construct(){
    $this->font_name='Arial';
    $this->color="#000000";
    $this->bgcolor=null;
    $this->size=10;
    $this->bold=0;
    $this->italic=0;
    $this->underline='None';
    $this->align='Left';
    $this->valign='Bottom';
    $this->border_left=0;
    $this->border_top=0;
    $this->border_right=0;
    $this->border_bottom=0;
    $this->wrap_text=0;
    $this->number_format='';
  }

  public function setColor( $color ){
    global $sheet_colors;

    if( isset( $sheet_colors[ $color ] ) )
      $this->color=$sheet_colors[ $color ];
    else
      $this->color=$color;
  }

  public function setBgColor( $color ){
    global $sheet_colors;

    if( isset( $sheet_colors[ $color ] ) )
      $this->bgcolor=$sheet_colors[ $color ];
    else
      $this->bgcolor=$color;
  }

  public function setSize( $size ){
    $this->size=$size;
  }

  public function setBold(){
    $this->bold=1;
  }

  public function setItalic(){
    $this->bold=1;
  }

  public function setUnderline(){
    $this->underline='Single';
  }

  public function setAlign( $align ){      // Left, Center, Right, Justify
    $align=mb_strtoupper( $align );
    if( $align=='CENTER' ) $align='Center';
    elseif( $align=='RIGHT' ) $align='Right';
    elseif( $align=='JUSTIFY' ) $align='Justify';
    else $align='Left';
    $this->align=$align;
  }

  public function setVAlign( $valign ){    // Top, Center, Bottom
    $valign=mb_strtoupper( $valign );
    if( $valign=='TOP' ) $valign='Top';
    elseif( $valign=='CENTER' ) $valign='Center';
    elseif( $valign=='VCENTER' ) $valign='Center';
    else $valign='Bottom';
    $this->valign=$valign;
  }

  public function setBorder( $size ){
    $this->border_left=$size;
    $this->border_top=$size;
    $this->border_right=$size;
    $this->border_bottom=$size;
  }

  public function setTextWrap( $wrap ){
    $this->wrap_text=( $wrap ? 1 : 0 );
  }

  public function setNumFormat( $format ){
    $this->number_format=$format;
  }

  public function show(){
    echo '    <Style ss:ID="' . $this->id . '">' . "\n";
    echo '      <Alignment ss:Horizontal="' . $this->align . '" ss:Vertical="' . $this->valign . '" ss:WrapText="' . $this->wrap_text . '"/>' . "\n";
    echo '      <Borders>' . "\n";
    if( $this->border_bottom>0 )
      echo '        <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="' . $this->border_bottom . '"/>' . "\n";
    if( $this->border_left>0 )
      echo '        <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="' . $this->border_left . '"/>' . "\n";
    if( $this->border_right>0 )
      echo '        <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="' . $this->border_right . '"/>' . "\n";
    if( $this->border_top>0 )
      echo '        <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="' . $this->border_top . '"/>' . "\n";
    echo '      </Borders>' . "\n";
    echo '      <Font x:FontName="' . $this->font_name . '" ss:Size="' . $this->size . '" ss:Color="' . $this->color . '" ss:Bold="' . $this->bold . '" ss:Italic="' . $this->italic . '" ss:Underline="' . $this->underline . '"/>' . "\n";
    if( $this->bgcolor!==null ){
      echo '      <Interior ss:Color="' . $this->bgcolor . '" ss:Pattern="Solid"/>' . "\n";
    }
    if( $this->number_format!='' )
      echo '      <NumberFormat ss:Format="' . $this->number_format . '"/>' . "\n";
    echo '    </Style>' . "\n";
  }

}

class ExcelWorksheet{
  public $name;
  public $table;
  public $width;
  public $height;
  public $columns_width;
  public $rows_height;
  public $merge_across;
  public $merge_down;

  //~ function ExcelWorksheet( $name ){
  public function __construct($name){
    $this->name=$name;
    $this->table=array();
    $this->width=0;
    $this->height=0;
    $this->columns_width=array();
    $this->rows_height=array();
    $this->merge_across=array();
    $this->merge_down=array();
  }

  public function show(){
    ksort( $this->columns_width );
    ksort( $this->table );
    echo '  <Worksheet ss:Name="' . $this->name . '">' . "\n";
    echo '    <Table ss:ExpandedColumnCount="' . ($this->width+1) . '" ss:ExpandedRowCount="' . ($this->height+1) . '" ss:DefaultColumnWidth="60">' . "\n";
    foreach( $this->columns_width as $col=>$size )
      echo '      <Column ss:Index="' . ( $col + 1 ) . '" ss:Width="' . $size . '"/>' . "\n";
    foreach( $this->table as $row=>$data ){
      echo '      <Row ss:Index="' . ($row+1) . '"';
      if( isset( $this->rows_height[ $row ] ) )
        echo ' ss:Height="' . $this->rows_height[ $row ] . '"';
      echo '>' . "\n";
      $data=explode( '<', $data );
      sort( $data, SORT_STRING );
      array_shift( $data );
      $data=implode( '>', $data );
      $data=explode( '>', $data );
      $cnt=count( $data )-1;
      $cell='';
      for( $i=0; $i<$cnt; $i+=4 ){
        $col=$data[ $i ]+0;
        $type=$data[ $i+2 ];
        $cell.='      <Cell ';
        if( $type=='Formula' ){
          $type='Number';
          $formula=$data[ $i+ 3 ];
          $data[ $i+3 ]='';
          $cell.='ss:Formula="' . $formula . '" ';
        }
        if( isset( $this->merge_across[ $row ][ $col ] ) ) $cell.='ss:MergeAcross="' . $this->merge_across[ $row ][ $col ] . '" ';
        if( isset( $this->merge_down[ $row ][ $col ] ) ) $cell.='ss:MergeDown="' . $this->merge_down[ $row ][ $col ] . '" ';
        $cell.='ss:Index="' . ($col+1) . '" ss:StyleID="' . $data[ $i+1 ] . '"><Data ss:Type="' . $type . '">' . $data[ $i+3 ] . '</Data></Cell>' . "\n";
      }
      unset( $data );
      echo $cell;
      echo '    </Row>' . "\n";
    }
    echo '    </Table>' . "\n";
    echo '    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">' . "\n";
    echo '     <PageSetup>' . "\n";
    echo '      <Header x:Margin="0"/>' . "\n";
    echo '      <Footer x:Margin="0"/>' . "\n";
    echo '      <PageMargins x:Bottom="0.984251969" x:Left="0.78740157499999996" x:Right="0.78740157499999996" x:Top="0.984251969"/>' . "\n";
    echo '     </PageSetup>' . "\n";
    echo '     <ProtectObjects>False</ProtectObjects>' . "\n";
    echo '     <ProtectScenarios>False</ProtectScenarios>' . "\n";
    echo '    </WorksheetOptions>' . "\n";
    echo '  </Worksheet>' . "\n";
  }

  public function _setWidth( $col ){
    if( $col>$this->width  ) $this->width=$col;
  }

  public function _setHeight( $row ){
    if( $row>$this->height ) $this->height=$row;
  }

  public function _addCell( $row, $col, $value, $type, $style ){
    $this->_setWidth( $col );
    $this->_setHeight( $row );

    $value=strtr( $value, array( "\r\n"=>'&#10;', '"'=>'&quot;', '\''=>'&apos;', '<'=>'&lt;', '>'=>'&gt;', '&'=>'&amp;'  ) );
    $cell=sprintf( '%05d>%s>%s>%s<', $col, ($style==null ? 'Default' : $style->id ), $type, $value);
    if( isset( $this->table[ $row ] ) ) $this->table[ $row ].=$cell;
    else $this->table[ $row ]=$cell;
  }

  public function write( $row, $col, $value, $style=null ){
    $this->_addCell( $row, $col, $value, 'String', $style );
  }

  public function writeString( $row, $col, $value, $style=null ){
    if( is_numeric( $value ) )
      $this->_addCell( $row, $col, $value*1, 'Number', $style );
    else
      $this->_addCell( $row, $col, $value, 'String', $style );
  }

  public function writeNumber( $row, $col, $value, $style=null ){
    $this->_addCell( $row, $col, $value*1, 'Number', $style );
  }

  public function writeFormula( $row, $col, $value, $style=null ){
    $this->_addCell( $row, $col, $value, 'Formula', $style );
  }

  public function setColumn( $from, $to, $size ){
    $this->_setWidth( $to );

    for( $i=$from; $i<=$to; $i++ )
      $this->columns_width[ $i ]=$size*4;
  }

  public function setRow( $row, $height ){
    $this->_setHeight( $row );
    $this->rows_height[ $row ]=$height*1.5;
  }

  public function setMerge( $f1, $c1, $f2, $c2 ){
    $this->_setWidth( $c2 );
    $this->_setHeight( $f2 );
    if( $c2-$c1>0 ) $this->merge_across[ $f1 ][ $c1 ]=$c2-$c1;
    if( $f2-$f1>0 ) $this->merge_down[ $f1 ][ $c1 ]=$f2-$f1;
  }

  public function setInputEncoding( $encoding ){
    // compatibilidad con PEAR
  }
}

global $sheet_colors;
$sheet_colors = array(
	'aqua'    => "#00FFFF",
	'cyan'    => "#00FFFF",
	'black'   => "#000000",
	'blue'    => "#0000FF",
	'brown'   => "#A52A2A",
	'magenta' => "#FF00FF",
	'fuchsia' => "#FF00FF",
	'gray'    => "#808080",
	'grey'    => "#808080",
	'green'   => "#008000",
	'lime'    => "#00FF00",
	'navy'    => "#000080",
	'orange'  => "#FFA500",
	'purple'  => "#800080",
	'red'     => "#FF0000",
	'silver'  => "#C0C0C0",
	'white'   => "#FFFFFF",
	'yellow'  => "#FFFF00"
);

?>

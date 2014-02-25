<?
function pdf()
{
    $this->load->helper('pdf_helper');
    /*
        ---- ---- ---- ----
        your code here
        ---- ---- ---- ----
    */
	$data="tes buat pdf";
    $this->load->view('pdfreport', $data);
}
?>
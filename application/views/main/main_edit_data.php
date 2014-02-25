<script>
    function doCetak(no) {
        var w = window.open("../report/tanda_terima/tanda_terima?nomor_pengaduan=" + no);
    }
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title><?php echo $title; ?></title>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/themes/base/jquery.ui.all.css">
        <script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui/jquery.ui.core.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.widget.js"></script>
        <script src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/ui//jquery.ui.datepicker.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3.custom/development-bundle/demos/demos.css">
        <script>
            $(function() {
                //('setDate', new Date());

                $("#tanggal_berkas").datepicker();
                $("#tanggal_pengaduan").datepicker();
                $("#perkiraan_penyelesaian").datepicker();

                $('#ppp tr').click(function(event) {
                    //alert($(this).attr('id')); //trying to alert id of the clicked row
                    $("#petugas_pelayanan_pengaduan").val($(this).attr('id'));

                });

                $('#jp tr').click(function(event) {
                    //alert($(this).attr('id')); //trying to alert id of the clicked row
                    $("#jenis_permohonan").val($(this).attr('id'));

                });
                $('#lokasi tr').click(function(event) {
                    lokasi = $(this).attr('id');
                    lokasi = lokasi.split("-");
                    $("#kode_desa").val(lokasi[0]);
                    $("#kelurahan_aduan").val(lokasi[1]);
                    $("#kecamatan_aduan").val(lokasi[2]);
                });
                $('#disposisi tr').click(function(event) {
                    $("#bagian").val($(this).attr('id'));
                });

            });

        </script>	
    </head>
                
    <body>
        <div class="msg"><?php echo $message; ?></div>
        <?php
        $username = $this->session->userdata('username');
        $level = $this->session->userdata('level');
        $apl_status = $pengaduan_data->apl_status;
        if ($level != "user") {
            $readonly = "readonly='readonly'";
            $disabled = "disabled='disabled'";
        } else {
            if ($apl_status != "REG") {
                $readonly = "readonly='readonly'";
                $disabled = "disabled='disabled'";
            } else {
                $readonly = "";
                $disabled = "";
            }
        };
        ?>
        <div class="content">
            <h1><?php echo $title; ?></h1>

            <table width="1024px" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="title_head">KANTOR PERTANAHAN KOTA PEKANBARU � <i>aplikasi pengaduan masyarakat (dumas)</i> </td>
                    <td class="title_user">User : <?= $username ?></td>
                </tr>	
            </table>	
            <form method="post" action="<?php echo $action; ?>">

                <div class="data">
                    <table width="1024px" cellspacing="0" cellpadding="5">

                        <tr >
                            <td class="title_subhead" colspan="8">
                            <input type="button"  name="choice" onClick="window.open('../report/tanda_terima/tanda_terima?nomor_pengaduan=<?= $pengaduan_data->nomor_pengaduan; ?>', 'popuppage', 'width=950,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');" value="Cetak"/></td>
                        </tr>

                        <tr >
                            <td class="title_subhead" colspan="8">1. Data Pengaduan</td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">1.a.</td>
                            <td class="detil_field_left" width="160px">Nomor</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="300px">
                                <input type="text" id="nomor_pengaduan" name="nomor_pengaduan"  readonly="readonly" value="<?php echo $pengaduan_data->nomor_pengaduan; ?>"/>
                            </td>
                            <td class="detil_field_left" width="160px">Tanggal pengaduan</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="372px">
                                <?php
                                $date = date_create($pengaduan_data->tanggal_pengaduan);
                                $date_ref1 = date_format($date, 'd-m-Y');
                                ?>
                                <input type="text" id="tanggal_pengaduan" name="tanggal_pengaduan" value="<?php echo $date_ref1; ?>" <?= $readonly ?>/>
                                <div class="form-error"><?php echo form_error('tanggal_pengaduan'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">1.b.</td>
                            <td class="detil_field_left" width="160px">Petugas</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <input type="text" id="petugas_pelayanan_pengaduan" maxlength="100px" size="50px" name="petugas_pelayanan_pengaduan"  <?= $readonly ?> value="<?php echo $pengaduan_data->petugas_pelayanan_pengaduan; ?>"/>
                                <div class="form-error"><?php echo form_error('petugas_pelayanan_pengaduan'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">&nbsp;</td>
                            <td class="detil_field_left" width="160px">&nbsp;</td>
                            <td class="detil_field_left" width="5px">&nbsp;</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <div class="content_table">
                                    <table id="ppp" class="tbselect" cellpadding="0" cellspacing="0">
                                        <?
                                        foreach ($ppp as $row_ppp) {
                                            echo '<tr id="' . $row_ppp->id . '-' . $row_ppp->user . '" >
                                                                                                              <td width="20px">' . $row_ppp->id . '-</td>      
                                                                                                              <td  width="300px">' . $row_ppp->user . '</td>      
                                                                                                             </tr>';
                                        }
                                        ?>		 
                                    </table>
                                </div>				
                            </td>

                        </tr>
                        <tr >
                            <td class="title_subhead" colspan="8">2. Data Pengadu</td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">2.a.</td>
                            <td class="detil_field_left" width="160px">Nama 

                            </td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="300px">
                                <input  <?= $readonly ?> type="text" id="nama_lengkap" name="nama_lengkap" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->nama_lengkap; ?>"/>
                                <div class="form-error"><?php echo form_error('nama_lengkap'); ?></div>
                            </td>
                            <td class="detil_field_left" width="160px">No. Identitas</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="372px">
                                <input  <?= $readonly ?> type="text" id="nomor_identitas" name="nomor_identitas"  value="<?php echo $pengaduan_data->nomor_identitas; ?>"/>
                                <div class="form-error"><?php echo form_error('nomor_identitas'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">2.b.</td>
                            <td class="detil_field_left" width="160px">Kuasa dari</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <input  <?= $readonly ?> type="text" id="nama_kuasa" name="nama_kuasa" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->nama_kuasa; ?>"/>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">2.c.</td>
                            <td class="detil_field_left" width="160px">Alamat</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <input  <?= $readonly ?> type="text" id="alamat" name="alamat" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->alamat; ?>"/>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">2.d.</td>
                            <td class="detil_field_left" width="160px">Nomor HP</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="300px">
                                <input type="text"  <?= $readonly ?> id="handphone" name="handphone" maxlength="100px" size="20px" value="<?php echo $pengaduan_data->handphone; ?>"/>
                                <div class="form-error"><?php echo form_error('handphone'); ?></div>
                            </td>
                            <td class="detil_field_left" width="160px">Telepon</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="372px">
                                <input type="text"  <?= $readonly ?> id="telepon" name="telepon" maxlength="100px" size="20px" value="<?php echo $pengaduan_data->telepon; ?>" />
                                <div class="form-error"><?php echo form_error('telepon'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">2.e.</td>
                            <td class="detil_field_left" width="160px">Email	</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <input type="text"  <?= $readonly ?> id="email" name="email" maxlength="100px" size="50px"  value="<?php echo $pengaduan_data->email; ?>"/>
                            </td>
                        </tr>
                        <tr >
                            <td class="title_subhead" colspan="8">3. Materi Pengaduan</td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">3.a.</td>
                            <td class="detil_field_left" width="160px">No. Berkas</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="300px">
                                <input type="text" id="nomor_berkas"  <?= $readonly ?> name="nomor_berkas" value="<?php echo $pengaduan_data->nomor_berkas; ?>"/>
                                <div class="form-error"><?php echo form_error('nomor_berkas'); ?></div>
                            </td>
                            <td class="detil_field_left" width="160px">Tanggal</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="372px">
                                <?php
                                $date = date_create($pengaduan_data->tanggal_berkas);
                                $date_ref2 = date_format($date, 'd-m-Y');
                                ?>
                                <input type="text" id="tanggal_berkas"  <?= $readonly ?> name="tanggal_berkas" value="<?php echo $date_ref2; ?>"/>
                                <div class="form-error"><?php echo form_error('tanggal_berkas'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">3.b.</td>
                            <td class="detil_field_left" width="160px">Jenis Permohonan 	</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <input type="text"  <?= $readonly ?> id="jenis_permohonan" name="jenis_permohonan" maxlength="100px"  size="50px" value="<?php echo $pengaduan_data->jenis_permohonan; ?>"/>
                                <div class="form-error"><?php echo form_error('jenis_permohonan'); ?></div>
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">&nbsp;</td>
                            <td class="detil_field_left" width="160px">&nbsp;</td>
                            <td class="detil_field_left" width="5px">&nbsp;</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <div class="content_table">
                                    <table id="jp" class="tbselect" cellpadding="0" cellspacing="0">
                                        <?
                                        foreach ($jenis_permohonan as $row_jenis_permohonan) {
                                            echo '<tr id="' . $row_jenis_permohonan->kode_jenis_permohonan . '-' . $row_jenis_permohonan->jenis_permohonan . '" >
                                                                                                              <td width="20px">' . $row_jenis_permohonan->kode_jenis_permohonan . '-</td>      
                                                                                                              <td  width="300px">' . $row_jenis_permohonan->jenis_permohonan . '</td>      
                                                                                                             </tr>';
                                        }
                                        ?>		 
                                    </table>
                                </div>				
                            </td>

                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">3.d.</td>
                            <td class="detil_field_left" width="160px">Lokasi Kel</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="300px">
                                <input type="text"  <?= $readonly ?> id="kelurahan_aduan" name="kelurahan_aduan" maxlength="100px" size="40px" value="<?php echo $pengaduan_data->kelurahan_aduan; ?>" />
                                <input type="button" name="choice"  <?= $disabled ?> onClick="window.open('../popup_master/kelurahan', 'popuppage', 'width=400,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');" value="..."/>
                            </td>
                            <td class="detil_field_left" width="160px">Kecamatan</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td class="detil_field_left" width="372px">
                                <input type="text"  <?= $readonly ?> id="kecamatan_aduan" name="kecamatan_aduan" maxlength="100px" size="40px" value="<?php echo $pengaduan_data->kecamatan_aduan; ?>"  />
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">&nbsp;</td>
                            <td class="detil_field_left" width="160px">&nbsp;</td>
                            <td class="detil_field_left" width="5px">&nbsp;</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <div class="content_table_wide">
                                    <table id="lokasi" class="tbselect" cellpadding="0" cellspacing="0">
                                        <?
                                        foreach ($lokasi as $row_lokasi) {
                                            echo '<tr id="' . $row_lokasi->kode_desa . '-' . $row_lokasi->nama_desa . '-' . $row_lokasi->kecamatan . '" >
                                                                                                              <td  width="300px">' . $row_lokasi->nama_desa . '</td>      
                                                                                                              <td  width="300px">' . $row_lokasi->kecamatan . '</td>      
                                                                                                             </tr>';
                                        }
                                        ?>		 
                                    </table>
                                </div>				
                            </td>

                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">3.e.</td>
                            <td class="detil_field_left" width="160px">Kode Desa</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <input type="text"  <?= $readonly ?> id="kode_desa" name="kode_desa" value="<?php echo $pengaduan_data->kode_desa; ?>" />
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">3.f.</td>
                            <td class="detil_field_left" width="160px">Isi Pengaduan</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <textarea id="uraian_aduan"  <?= $readonly ?> name="uraian_aduan" rows="4" cols="50"   ><?php echo $pengaduan_data->uraian_aduan; ?></textarea>
                            </td>
                        </tr>
                        <tr >
                            <td class="title_subhead" colspan="8">4. Penerusan Pengaduan</td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">4.a.</td>
                            <td class="detil_field_left" width="160px">Disposisi ke</td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <input  <?= $readonly ?> type="text" id="bagian" name="bagian" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->bagian; ?>" />
                                <div class="form-error"><?php echo form_error('bagian'); ?></div>
                            </td>

                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">&nbsp;</td>
                            <td class="detil_field_left" width="160px">&nbsp;</td>
                            <td class="detil_field_left" width="5px">&nbsp;</td>
                            <td colspan="3" class="detil_field_left" width="827px">
                                <div class="content_table_wide">
                                    <table id="disposisi" class="tbselect" cellpadding="0" cellspacing="0">
                                        <?
                                        foreach ($disposisi as $row_disposisi) {
                                            echo '<tr id="' . $row_disposisi->kode_bagian . '-' . $row_disposisi->bagian . '" >
                                                                                                              <td  width="20px">' . $row_disposisi->kode_bagian . '-</td>      
                                                                                                              <td  width="350px">' . $row_disposisi->bagian . '</td>      
                                                                                                             </tr>';
                                        }
                                        ?>		 
                                    </table>
                                </div>				
                            </td>

                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">4.b.</td>
                            <td class="detil_field_left" width="160px">Petugas penghubung </td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <input  <?= $readonly ?> type="text" id="petugas_penghubung" name="petugas_penghubung" value="<?php echo $pengaduan_data->petugas_penghubung; ?>" />
                            </td>
                        </tr>
                        <tr >
                            <td class="detil_field_left" width="8px">&nbsp;</td>
                            <td class="detil_field_left" width="10px">4.c.</td>
                            <td class="detil_field_left" width="160px">Catatan </td>
                            <td class="detil_field_left" width="5px">:</td>
                            <td colspan="4" class="detil_field_left" width="827px">
                                <textarea  <?= $readonly ?>  id="catatan" name="catatan"  rows="4" cols="50"  ><?php echo $pengaduan_data->catatan; ?></textarea>
                            </td>
                        </tr>
                        <?php
                        if ($level == "verifikator" OR $level == "plt" or $apl_status == "RES") {
                            ?>
                            <tr >
                                <td class="detil_field_left" width="8px">&nbsp;</td>
                                <td class="detil_field_left" width="10px">4.d</td>
                                <td class="detil_field_left" width="160px">Disposisi ke Subseksi</td>
                                <td class="detil_field_left" width="5px">:</td>
                                <td colspan="4" class="detil_field_left" width="827px"><input   <?= $readonly ?>  type="text" id="seksi" name="seksi" maxlength="100px" size="50px" value="<?php echo $pengaduan_data->seksi; ?>" />
                                    <input type="button"   <?= $disabled ?>  name="choice" onClick="window.open('../popup_master/seksi', 'popuppage', 'width=400,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100');" value="..."/>
                                </td>

                            </tr>
                            <tr >
                                <td class="detil_field_left" width="8px">&nbsp;</td>
                                <td class="detil_field_left" width="10px">4.e.</td>
                                <td class="detil_field_left" width="160px">Catatan Disposisi</td>
                                <td class="detil_field_left" width="5px">:</td>
                                <td colspan="4" class="detil_field_left" width="827px"><textarea  <?= $readonly ?>  id="catatan_disposisi" name="catatan_disposisi"  rows="4" cols="50"  ><?php echo $pengaduan_data->catatan_disposisi; ?></textarea></td>

                            </tr>
                            <?
                        }
                        ?>
                        <?php
                        if ($level == "plt" or $apl_status == "RES") {
                            if ($level == "plt") {
                                $readonly = "";
                            };
                            ?>
                            <tr >
                                <td class="detil_field_left" width="8px">&nbsp;</td>
                                <td class="detil_field_left" width="10px">4.f.</td>
                                <td class="detil_field_left" width="160px">Catatan Status Berkas</td>
                                <td class="detil_field_left" width="5px">:</td>
                                <td colspan="4" class="detil_field_left" width="827px"><textarea   <?= $readonly ?> id="catatan_status_berkas" name="catatan_status_berkas"  rows="4" cols="50"  ><?php echo $pengaduan_data->catatan_status_berkas; ?></textarea></td>

                            </tr>
                            <tr >
                                <td class="detil_field_left" width="8px">&nbsp;</td>
                                <td class="detil_field_left" width="10px">4.g.</td>
                                <td class="detil_field_left" width="160px">Posisi saat ini</td>
                                <td class="detil_field_left" width="5px">:</td>
                                <td colspan="4" class="detil_field_left" width="827px"><?= date('d-m-Y') ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perkiraan Penyelesaian : &nbsp;<input type="text"  <?= $readonly ?> id="perkiraan_penyelesaian" name="perkiraan_penyelesaian" value="<?php echo $pengaduan_data->perkiraan_penyelesaian; ?>"  /></td>
                            </tr>
                            <?
                        }
                        if ($apl_status != "RES") {
                            ?>
                            <tr >
                                <td align="center"><input type="submit" value="Simpan Edit"/></td>
                            </tr>
                            <?
                        }
                        ?>
                        <tr >
                            <td align="center" colspan="8"><hr/></td>
                        </tr>
                        <?
                        if ($level == "user") {
                            //return site_url('kirim_verifikasi').'?nomor_pengaduan='.$row->nomor_pengaduan.'&bagian='.$row->bagian;
                            ?>
                            <tr >
                                <td align="center"  colspan="8">
                                    <a href="../kirim_verifikasi?bagian=<?php echo $pengaduan_data->bagian; ?>&nomor_pengaduan=<?php echo $pengaduan_data->nomor_pengaduan; ?>">Kirim Verifikasi</a>
                                    <a href="../main/entri_pengaduan">Kembali ke Daftar Pengaduan</a>

                                </td>
                            </tr>
                            <?
                        };
                        if ($level == "verifikator") {
                            //return site_url('kirim_verifikasi').'?nomor_pengaduan='.$row->nomor_pengaduan.'&bagian='.$row->bagian;
                            ?>
                            <tr >

                                <td align="center"  colspan="8"><a href="../kirim_verifikator?nomor_pengaduan=<?php echo $pengaduan_data->nomor_pengaduan; ?>">Kirim Verifikasi</a><input type="button" value="Cetak Tanda Terima"/><input type="button" value="Tunda"/></td>
                                <a href="../verifikator_main/entri_pengaduan">Kembali ke Daftar Pengaduan</a>
                            </tr>
                        <?
                        };
                        if ($level == "plt") {
                            ?>
                            <tr >
                                <td align="center"  colspan="8">
                                    <a href="<?php echo site_url('main/update_res?nomor_pengaduan=' . $pengaduan_data->nomor_pengaduan . ''); ?>">Kirim</a>
                                    <a href="<?php echo site_url('report/tanda_terima/tanda_terima'); ?>">Cetak Tanda Terima</a>
                                    <input type="button" value="Cetak Tanda Terima"/><input type="button" value="Tunda"/></td>
                            </tr>
<? }; ?>

                    </table>
                </div>
            </form>
            <br />
        </div>
    </body>
</html>
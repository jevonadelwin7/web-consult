<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media print {
        table tr td{
            font-size: 13px;
        }
        @page {
        size: auto;
        margin: 0;
        }
        .tengah{border-bottom: 3px solid #000;width:100%}
        .tengahb{border-bottom: 1px solid #000;width:100%;}
        
        }
    </style>
     <script>
        window.onload = function() {
          window.print();
        };
      </script>
</head>
<body >
    @foreach ($surat as $key => $item )
    <center>
        <table>
            <tr>
                <td><img src="/adminfrontend/assets/img/Logo_Mentawai.jpg" width="75" height="90"></td>
                <td>
                    <center>
                        <font size="4">PEMERINTAH KABUPATEN KEPULAUAN MENTAWAI</font><br>
                        <font size="5"><b>INSPEKTORAT</b></font><br>
                        <font size="2">Tuapejat KM.05 Sipora Utara Kab. Kepulauan Mentawai</font><br>
                        <font size="2">Telp. (0759) 320006 - Fax :(0759) 320223</font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2"class='tengah'>
                    
                </td>
                

            </tr>
            <tr>
                <td colspan="2"class='tengahb'>
                    
                </td>
                

            </tr>
        </table>
        <br>
        <table >
            <tr>

            </tr>
            <tr>
                <center>
                    <font size="2"><b> <u>SURAT KETERANGAN TIDAK PERNAH DIJATUHI HUKUMAN</u> </b></font><br>
                    <font size="2"><b> <u>DISIPLIN TINGKAT SEDANG/BERAT</u> </b></font><br>
                    <font size="1"><b>Nomor : 700/          /Insp-KKM/XII-2022</b></font><br>
                </center>
            </tr>
        </table>
        <table >
            <tr> 
                <td>Yang bertanda tangan di bawah ini</td>
                <td width="345">:</td>
            </tr>
            <br>
            <tr> 
                <td>Nama </td>
                <td width="345">: {{$item->nama_pejabat}}</td>
            </tr>
            <tr> 
                <td>Nip </td>
                <td width="345">: {{$item->nip_pejabat}}</td>
            </tr>
            <tr> 
                <td>Pangkat/Gol </td>
                <td width="345">: {{$item->pang_gol_pejabat}}</td>
            </tr>
            <tr> 
                <td>Jabatan </td>
                <td width="345">: {{$item->jabatan_pejabat}} </td>
            </tr>
        </table>
        <br>
        <table  width="540">
            <tr> 
                <td>Dengan ini menerangkan</td>
                <td width="345">:</td>
            </tr>
            <br>
            <tr> 
                <td>Nama </td>
                <td width="345">: {{$item->nama_pemohon}}</td>
            </tr>
            <tr> 
                <td>Nip </td>
                <td width="345">: {{$item->nip_pemohon}}</td>
            </tr>
            <tr> 
                <td>Pangkat/Gol </td>
                <td width="345">: {{$item->pang_gol_pemohon}}</td>
            </tr>
            <tr> 
                <td>Jabatan </td>
                <td width="345">: {{$item->jabatan_pemohon}}</td>
            </tr>
            <tr> 
                <td>Unit Organisasi </td>
                <td width="345">: {{$item->unit_kerja_pemohon}}</td>
            </tr>
            
        </table>
        <br>
        <table  width="540">
            <tr> 
                <td width="670">bahwa yang bersangkutan diatas tidak pernah dijatuhi hukuman disiplin tingkat sedang dan atau berat serta tidak dalam proses pemeriksaan pelanggaran disiplin.</td>
        
            </tr>
        </table>
        <br>
        <table  width="540">
            <tr> 
                <td width="670">Demikian Surat Pernyataan ini dibuat dengan sebenar-benarnya untuk dapat digunakan sebagaimana mestinya.</td>
        
            </tr>
        </table>
        
        <br>
        <table  width="540">
            <tr> 
                <td width="350"></td>
                <td >{{$item->tanggal_surat}}</td>
            </tr>
            <tr> 
                <td width="350"></td>
                <td ><b>{{$item->jabatan_ttd}}</b></td>
            </tr>
            <tr> 
                <td width="350" height="50"></td>
                <td>
                    @if ($item->status == 1)
                    <img src="{{asset('adminfrontend')}}/assets/img/ttd.png" width="100px" height="50px">
                    @else
                    @endif
                </td>
            </tr>
            <tr> 
                <td width="350"></td>
                <td ><b><u>{{$item->nama_pejabat}} </u></b></td>
            </tr>
            <tr> 
                <td width="350"></td>
                <td >NIP. {{$item->nip_pejabat}}</td>
            </tr>
        </table>
    </center>
    @endforeach
</body>
</html>
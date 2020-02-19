
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style type="text/css">
	body{
		font-family: Ubuntu;
	}
</style>
       <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
	<title>Form</title>
</head>

<body>
<h1 style="color:orange;">Selamat !</h1>
<p>Anda telah menjadi anggota histore,Berikut adalah data kemitraan anda : </p>
<b>
<table>
	<tr>
		<td style="width: 150px;">ID Mitra</td>
		<td>:{{$mitra_id}}</td>
		<td></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:{{$nama}}</td>
		<td></td>
	</tr>
	<tr>
		<td>No. Handphone</td>
		<td>:{{$hp}}</td>
		<td></td>
	</tr>
	<tr>
		<td>Lokasi</td>
		<td>:{{$alamat}}</td>
		<td></td>
	</tr>
</table>
</b>
<p>Terima Kasih sudah menjadi anggota HiStore. </p>

</body>
</html>
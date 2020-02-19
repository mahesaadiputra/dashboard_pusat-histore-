<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<style type="text/css">
	body{
		font-family: Ubuntu;
		margin-left: 600px;
		margin-right: 600px;


	}
	.w-150{
		width:150px;
	}
	h1{
		color:orange;
		font-size: 42px;
	}
	hr{
		width: 400px;
	}
	.wh-img{
		width: 500px;
		height: 250px;
		background-color: black;
	}
	.body{
		background-color: #dddddd;
		width: 500px;
	}

</style>
<body>
	<center>
  <img src="http://103.129.222.216:8000/img/mitra.png" style="width:80px; height:80px;" >
		<div class="body">
			<h1>Selamat !</h1>
			<p>Anda telah menjadi Mitra HiStore,Berikut adalah data kemitraan anda : </p>
			<b>
				<hr>
			<table>
				<tr>
					<td class="w-150">ID MITRA</td>
					<td>:</td>
					<td>{{$mitra_id}}</td>
				</tr>
				<tr>
					<td class="w-150">Nama</td>
					<td>:</td>
					<td>{{$nama}}</td>
				</tr>
				<tr>
					<td class="w-150">No. Handphone</td>
					<td>:</td>
					<td>{{$hp}}</td>
				</tr>
				<tr>
					<td class="w-150">Lokasi Mitra</td>
					<td>:</td>
					<td>{{$alamat}}</td>
				</tr>
			</table>
			<hr>
			</b>
		
			<p>Mohon simpan baik-baik nomor ID Mitra anda.<p>
			<p>Terima Kasih.</p>
</center>
</div>
</body>
</html>
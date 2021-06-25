<?php 

return [
	'title' => 'Agenda', 
	'desc' => 'Berikut ini adalah daftar seluruh data yang telah tersimpan di dalam database.', 
	'empty' => 'Sepertinya Anda belum memiliki :message.', 

	'created' => 'Data :title berhasil ditambah!', 
	'updated' => 'Data :title berhasil diubah!', 
	'deleted' => 'Beberapa data :title berhasil dihapus sekaligus!', 

	'create' => [
		'title' => 'Tambah :attribute', 
		'desc' => 'Silahkan lengkapi form berikut untuk menambahkan data baru.'
	],

	'edit' => [
		'title' => 'Ubah :attribute', 
		'desc' => 'Silahkan lakukan perubahan sesuai dengan kebutuhan.'
	], 

	'form' => [
		'title' => [
			'label' => 'Judul', 
			'placeholder' => 'Hint. Nama/Perihal kegiatan yang akan dilaksanakan', 
		],
		'place' => [
			'label' => 'Tempat', 
			'placeholder' => 'Ex. Ruang Rapat Utama', 
		],
		'guest' => [
			'label' => 'Tamu', 
			'placeholder' => 'Ex. Nama Pegawai, Nama Bidang atau Nama Tamu', 
		],
		'time' => [
			'desc' => 'Anda juga bisa menentukan waktu <b>jam/pukul</b> dengan menekan tombol <i class="glyphicon glyphicon-time"></i> dibawah tanggal.'
		]
	],

	'table' => [
		'label' => 'LABEL', 
	],

	'detail' => [
		'title' => 'Detail Agenda', 
		'content' => 'Perihal', 
		'place' => 'Lokasi', 
		'guest' => 'Dihadiri Oleh', 
		'time' => 'Waktu Acara', 
		'times' => 'Kali', 
		'visit' => 'Dikunjungi', 
		'uploader' => 'Uploader', 
	], 
];
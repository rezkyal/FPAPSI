@extends ('layouts.template')


@section ('content')
<section id="services" class="section section-padded">
		<div class="container">
			<div class="row text-center title">
				<h2>Jenis Reservasi</h2>
				<h4 class="light muted">Tempat yang bisa dipinjam yakni aula dan kelas</h4>
			</div>
			<div class="row services">
				<div class="col-md-6">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/heart-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">Aula</h4>
						<p class="description">Aula Teknik Informatika ITS memiliki kapasitas +-200 orang, dilengkapi dengan berbagai fasilitas yakni AC, Sound System, dan Proyektor</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/guru-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">Kelas</h4>
						<p class="description">Kelas Teknik Informatika ITS terdiri atas 8 kelas yang bisa dipinjam, dengan kapasitas perkelasnya 40 orang, dilengkapi dengan berbagai fasilitas yakni AC dan Proyektor</p>
					</div>
				</div>
			</div>
		</div>
		<div class="cut cut-bottom"></div>
</section>
@endsection
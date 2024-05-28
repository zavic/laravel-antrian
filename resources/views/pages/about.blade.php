<x-guest-layout title="Tentang">
    <div class="row flex-lg-row-reverse align-items-center g-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="{{ Storage::url('img/hero.jpeg') }}" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes"
            loading="lazy">
        </div>
        <div class="col-lg-6">
            <h2 class="pb-2 fw-bold">Tentang {{ config('app.name', 'Laravel') }}</h2>
            <p class="lead">Dengan Aplikasi {{ config('app.name', 'Laravel') }} ini, kami menawarkan solusi efisien
                untuk mengelola alur pasien dan
                pengunjung dengan lancar di berbagai fasilitas seperti rumah sakit, balai desa, dan puskesmas.
                Dengan antarmuka yang mudah digunakan dan fitur canggih, aplikasi ini memastikan pengalaman yang
                nyaman dan terorganisir bagi semua pengguna, sambil mengurangi waktu tunggu dan meningkatkan
                produktivitas layanan.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-outline-primary btn-lg px-4 me-md-2">Daftar Akun</button>
                <a class="btn btn-lg px-4 " href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</x-guest-layout>

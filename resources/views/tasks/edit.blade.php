@extends('layouts.app') <!--burada "views/layouts/app.blade.php" dosyasını include ediyoruz  -->

@section('content') {{--  burada "views/layouts/app.blade.php" içerisinde bulunan @yield('content')
ile belirlenen yere alt satırdaki kodları dahil eder --}}
<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card rounded-3">
                    <div class="card-body p-4">
                        <h4 class="text-center my-3 pb-3">Görevi Düzenle</h4>
                        {{-- aşağıdaki form index.blade.php sayfasından yönlendirilen id bilgisine göre 
                        görevin sadece task sütununu yani görevi günceller görev durumunu güncellemez
                        bu işlem TaskController de bulunan updateTaskContent fonksiyonunda yer alır post methodu ile
                        istek atılır ve methodu @method komutu ile PUT isteği olduğu belirtilir yani güncelleme 
                        işlemi yapılacağını sunucu tarafına söyler--}}
                        <form action="{{ route('tasks.updateContent', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT') {{--PUT GÜNCELLEME İŞLEMİ İÇİN KULLANILIR!!!--}}
                            <div class="mb-3">
                                <label for="task" class="form-label">Görev</label>
                                {{-- alttaki inputta value="{{ $task->task }}" komutu ile index.blade.php den gönderilen id ye göre 
                                görev alınır ve input alanına yazdırılır. kullanıcı değişikliği yapıp güncelle butonuna bastıktan sonra
                                görev formdaki action ile sunucuya name="task" değişkeni ile iletilir.--}}
                                <input type="text" id="task" name="task" class="form-control" value="{{ $task->task }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app') <!--burada "views/layouts/app.blade.php" dosyasını include ediyoruz  -->

@section('content')
    {{--  burada "views/layouts/app.blade.php" içerisinde bulunan @yield('content')
ile belirlenen yere alt satırdaki kodları dahil eder --}}

    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            <h4 class="text-center my-3 pb-3">To Do List</h4>
                            {{-- alt satırdaki form action da route ile tasks.store rotasına yönkendirme yapıyoruz
                            TaskController içerisinde bulunan store fonksiyonundaki işlemleri ekle butonuna bastığımızda
                            gerçekleştirir. --}}
                            <form action="{{ route('tasks.store') }}" method="POST"
                                class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                @csrf
                                <div class="col-12">
                                    <div data-mdb-input-init class="form-outline">
                                        {{-- name="task" girilen değeri sunucuya gönderir yani görev içeriğini
                                        veri tabanına gönderir store fonksiyonunda veri ekleme işlemleri yapılmakta
                                        veri tabanındaki task sütununa girilen veriyi eklemiş oluruz bu sayede --}}
                                        <input type="text" id="taskInput" name="task" class="form-control"
                                            placeholder="Bir görev giriniz." required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary">Ekle</button>
                                </div>
                            </form>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">Görev İçeriği</th>
                                        <th scope="col">Görev Durumu</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- foreach dönügüsünde "($tasks as $task)" bu komut ile tasks 
                                    veri tabanını artık task olarak isimlendirdik bu sadece kodda geçerli
                                    veri tabanının isminde değişiklik olmayacak --}}
                                    @foreach ($tasks as $task)
                                        <tr>
                                            {{-- alt satırda task ismi ile çağırdığımız veri tabanındaki
                                            task isimli sütundaki verileri td etiketinin içerisine dinamik bir
                                            şekilde yazdırdık --}}
                                            <td>{{ $task->task }}</td>
                                            <td>
                                                {{-- 
                                                her bir görevin bulunduğu satırda görev durumunu belirtmek için
                                                checkbox lar bulunur bu görevin devam ettiğini ve tamamlandığını belirtir
                                                
                                                ilk veri ekleme yapıldığında cehckbox işaretli olmaz ve görev devam ediyor 
                                                olarak belirtilir işaretlenirse görev tamamlandı olarak belirtilir
                                                alttaki formun tasks.update fonksiyonuna yönlendirir ve görevin durumunu
                                                günceller
                                                --}}
                                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-check">
                                                        {{-- alttaki input ise checkboxun işaretli olup olmadığını kontrol eder ve 
                                                        işaret durumuna göre devam ediyor veya tamamlanmış olarak labele yazdırır
                                                        checkbox işaretlendiğinde "onchange="this.form.submit()" komutu ile form gönderilir
                                                        ve görev durumu güncellenir. --}}
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            {{ $task->status ? 'checked' : '' }}
                                                            onchange="this.form.submit()">
                                                        <label class="form-check-label">
                                                            {{ $task->status ? 'Tamamlanmış' : 'Devam Ediyor' }}
                                                        </label>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                {{-- alttaki formun actionu ise tasks.edit rotasına yönlendirir ve güncelleme
                                                sayfasını açar tabi bu sayfaya görevin id bilgileri ulaşır ve açılan sayfada o id
                                                numarasına göre işlemler gerçekleşir --}}
                                                <form action="{{ route('tasks.edit', $task->id) }}" method="GET"
                                                    class="d-inline">
                                                    @csrf
                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                        class="btn btn-warning">Düzenle</a>
                                                </form>
                                                {{-- alttaki formun action kısmı ise tasks.destroy rotasına görevin id bilgileriyle 
                                                yönlendirir ve id numarasına göre destroy formundaki id bilgisine göre silme işlemleri
                                                gerçekleşir --}}
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sil</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

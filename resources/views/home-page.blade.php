@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/land-page.css')}}" >
@endsection
@section('content')
    <div class="container-fluid bg-primary p-3" dir="rtl">
        <div class="row text-right text-sm-left">
            <div class="col d-flex flex-column justify-content-center pl-md-5">
                <h1 class="text-white text-right px-lg-5 mt-3" style="font-size: 60px">مرحبا بك في منصة وظفني</h1>
                <p class="text-white text-right px-lg-5">
                    منصة وظفني عبارة عن منصة اساطيع من خلالها اذا كنت صاحب عمل البحث عن موظفين وفي نفس الوقت اذا كنت تبحث عن عمل فأنت في المكان الصحيح.
                    منصة وظفني عبارة عن منصة اساطيع من خلالها اذا كنت صاحب عمل البحث عن موظفين وفي نفس الوقت اذا كنت تبحث عن عمل فأنت في المكان الصحيح.
                    منصة وظفني عبارة عن منصة اساطيع من خلالها اذا كنت صاحب عمل البحث عن موظفين وفي نفس الوقت اذا كنت تبحث عن عمل فأنت في المكان الصحيح.
                </p>
                <button class="btn btn-light text-primary mx-auto mr-md-0 mr-lg-5 w-25 ">انضم الآن</button>
            </div>
            <div class="col d-none d-md-block">
                <img src="{{asset('imgs/land-back2.png')}}" width="100%" height="100%" class="land-image">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="text-center font-weight-bold">لماذا نحن ؟</h1>
        <div class="row mt-5">
            <dov class="col-sm-4 mb-3">
                <div class="card pb-1">
                    <div class="card-img">
                        <img src="{{asset('imgs/connections.svg')}}" width="100%" height="100%">
                    </div>
                    <h3 class="card-title text-center mt-1">تواصل أسرع</h3>
                    <p class="card-description p-3 text-center">
                       كون شبكة اجتماعية مع اشخاص من نفس فئة عملك بكل سهولة ويسر.
                    </p>
                </div>
            </dov>
            <dov class="col-sm-4 mb-3">
                <div class="card pb-3">
                    <div class="card-img">
                        <img src="{{asset('imgs/security.svg')}}" width="100%" height="100%">
                    </div>
                    <h3 class="card-title text-center mt-3">أمان بياناتك</h3>
                    <p class="card-description p-3 text-center">
                        حميع المعلومات الشخصية محمية وذلك ضمن معايير الاستخدام والخصوصية
                    </p>
                </div>
            </dov>
            <dov class="col-sm-4 mb-3">
                <div class="card pb-2">
                    <div class="card-img">
                        <img src="{{asset('imgs/support.svg')}}" width="100%" height="100%">
                    </div>
                    <h3 class="card-title text-center mt-3">الدعم</h3>
                    <p class="card-description p-3 text-center">
                        خدمة الدعم متوفرة لدينا وبأعلى جودة ممكنة لنتمكن من حل مشاكلك.
                    </p>
                </div>
            </dov>
        </div>

    </div>
    <div class="container mt-5 p-3">
        <h1 class="text-center font-weight-bold ">أنضم لنا</h1>
        <div class="row mt-5">
            <div class="col-12 col-sm-6">
                    <div class="card py-2">
                        <div class="card-img">
                                <img src="{{asset('imgs/worker.png')}}" width="100%" height="100%">
                        </div>
                        <h3 class="card-title text-center">باحث عن وظيفة</h3>
                        <p class="card-description p-3 text-center">
                            انضم لنا لكي تجد فرص عمل تناسبك تخصصك وفي المكان الذي يناسبك.
                        </p>
                        <button class="mx-auto btn btn-outline-primary">Join Now</button>
                    </div>
            </div>
            <div class="col-12 col-sm-6">
                    <div class="card py-2">
                        <div class="card-img">
                            <img src="{{asset('imgs/hr.jpeg')}}" width="100%" height="100%">
                        </div>
                        <h3 class="card-title text-center">باحث عن موظف</h3>
                        <p class="card-description p-3 text-center">
                            انضم لنا لتجد عامل مناسب لشركتك أو مؤسستك
                        </p>
                        <button class="mx-auto btn btn-outline-primary">Join Now</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="container mt-5  p-3">
        <h1 class="font-weight-bold text-center mb-5"> تواصل معنا</h1>
        <div class="row">
            <div class="col-sm-6 px-2" dir="rtl">
                  <form>
                      <div class="d-flex flex-column justify-content-center">
                          <input type="email" class="form-control mb-3" placeholder="ادخل البريد الإلكتروتي">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                          <textarea rows="11" class="form-control" placeholder="ادخل الرسالة"></textarea>
                      </div>
                      <button class="btn btn-outline-primary mt-2 float-right">إرسال</button>
                  </form>
              </div>
            <div class="col-sm-6 d-none d-sm-block">
                <img src="{{asset('imgs/contact_us.svg')}}" width="100%">
            </div>
        </div>
    </div>
@endsection

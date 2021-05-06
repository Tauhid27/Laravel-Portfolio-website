@extends('Layout.app')

@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116116.15807726487!2d89.83140202539595!3d24.567447112381814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fd8cf1563cfb85%3A0x28392c1718c9b466!2sGopalpur%20Upazila!5e0!3m2!1sen!2sbd!4v1620329294481!5m2!1sen!2sbd" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-6 col-sm-6">
            <h3 class="service-card-title">ঠিকানা</h3>
            <hr>
            <p class="footer-text"><i class="fas fa-map-marker-alt"></i> শেখেরটেক ৮ মোহাম্মদপুর, ঢাকা  <i class="fas fa-phone"></i> ০১৭৮৫৩৮৮৯১৯  </p>
         
            <div class="form-group ">
                <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
            </div>
            <div class="form-group">
                <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="মোবাইল নং ">
            </div>
            <div class="form-group">
                <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="ইমেইল ">
            </div>
            <div class="form-group">
                <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
            </div>
            <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>
    </div>
</div>

@endsection
@extends('layouts.main')

@section('title', 'whyBiit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">
        <section class="whyBiit">
            <div class="whyBiit__row" id="mainContainer">
                <div class="whyBiit__row__left">
                    <div class="photo second-photo">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/4988d73d-0d49-4562-8729-c12a9add5725/6HwavVnFbt.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player>
                    </div>
                    <div class="photo fourth-photo">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/0734090d-b22d-4df4-a0c7-112c41e51274/QYglip8ncc.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player>
                    </div>
                </div>
                <div class="whyBiit__row__central">
                    <div class="first circle modal-button" id="firstModal" data-modal-id="firstModal">
                        <h4 class="circle__title" value-text="modulosCliente"></h4>
                    </div>
                    <div class="lines first-line">
                        <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <!-- Línea SVG -->
                            <line class="dashed-line" x1="20" y1="0" x2="80" y2="100"></line>
                        </svg>
                    </div>
                    <div class="second circle modal-button" id="secondModal" data-modal-id="secondModal">
                        <h4 class="circle__title" value-text="modulosComercio"></h4>
                    </div>
                    <div class="lines second-line">
                        <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <!-- Línea SVG -->
                            <line class="dashed-line" x1="80" y1="0" x2="20" y2="100"></line>
                        </svg>
                    </div>
                    <div class="third circle modal-button" id="thirdModal" data-modal-id="thirdModal">
                        <h4 class="circle__title" value-text="modulosProcesos"></h4>
                    </div>
                    <div class="lines third-line">
                        <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <!-- Línea SVG -->
                            <line class="dashed-line" x1="20" y1="0" x2="80" y2="100"></line>
                        </svg>
                    </div>
                    <div class="fourth circle modal-button" id="fourthModal" data-modal-id="fourthModal">
                        <h4 class="circle__title" value-text="modulosFactura"></h4>
                    </div>
                    <div class="lines fourth-line">
                        <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                            <!-- Línea SVG -->
                            <line class="dashed-line" x1="80" y1="0" x2="20" y2="100"></line>
                        </svg>
                    </div>
                    <div class="fifth circle modal-button" id="fifthModal" data-modal-id="fifthModal">
                        <h4 class="circle__title" value-text="modulosBusiness"></h4>
                    </div>
                </div>
                <div class="whyBiit__row__right">
                    <div class="photo first-photo">
                        {{-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/0734090d-b22d-4df4-a0c7-112c41e51274/QYglip8ncc.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player> --}}
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px" direction="1"
                            mode="normal" loop autoplay></lottie-player>
                        {{-- <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player src="https://lottie.host/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            playMode="normal" loop autoplay></dotlottie-player> --}}
                        {{-- https://lottie.host/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json --}}
                    </div>
                    <div class="photo third-photo">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/00a7d5c0-3302-4c36-8e6f-08a6c3d85be7/xwvdrMnD4u.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player>
                    </div>
                    <div class="photo fifth-photo">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/4988d73d-0d49-4562-8729-c12a9add5725/6HwavVnFbt.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player>
                    </div>
                </div>
            </div>
        </section>
        <section id="infoModal" class="modal">
            <div id="modalBox" class="modal__box">
                <span class="close" id="closeModalButton">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <div id="modalBodyContent">
                    <h2 class="body__subtitle" id="modalTitle" value-text=""></h2>
                    <span class="body__content" id="modalContent" value-text="">
                    </span>
                    <div class="body__photo">
                        <img src="" alt="" id="modalPhoto" style="width: 250px; height: 250px">
                        {{-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://lottie.host/0734090d-b22d-4df4-a0c7-112c41e51274/QYglip8ncc.json"
                            background="transparent" speed="1" style="width: 250px; height: 250px" direction="1"
                            mode="normal" loop autoplay></lottie-player> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection

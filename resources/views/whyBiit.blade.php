@extends('layouts.main')

@section('title', 'whyBiit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">
        <section class="whyBiit">
            <div class="whyBiit__row" id="mainContainer">
                {{-- <svg class="lines-svg">
                    <line class="liness first-lines" x1="65" y1="10" x2="85" y2="95"></line>
                </svg> --}}
                <div class="first circle modal-button" id="firstModal" data-modal-id="firstModal">
                    <h4 class="circle__title" value-text="modulosCliente"></h4>
                </div>
                <div class="lines first-line">
                    <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                        <!-- Línea SVG -->
                        <line class="dashed-line" x1="10" y1="0" x2="90" y2="100"></line>
                    </svg>
                </div>
                <div class="second circle modal-button" id="secondModal" data-modal-id="secondModal">
                    <h4 class="circle__title" value-text="modulosComercio"></h4>
                </div>
                <div class="lines second-line">
                    <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                        <!-- Línea SVG -->
                        <line class="dashed-line" x1="90" y1="0" x2="10" y2="100"></line>
                    </svg>
                </div>
                <div class="third circle modal-button" id="thirdModal" data-modal-id="thirdModal">
                    <h4 class="circle__title" value-text="modulosProcesos"></h4>
                </div>
                <div class="lines third-line">
                    <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                        <!-- Línea SVG -->
                        <line class="dashed-line" x1="10" y1="0" x2="90" y2="100"></line>
                    </svg>
                </div>
                <div class="fourth circle modal-button" id="fourthModal" data-modal-id="fourthModal">
                    <h4 class="circle__title" value-text="modulosFactura"></h4>
                </div>
                <div class="lines fourth-line">
                    <svg class="lines-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                        <!-- Línea SVG -->
                        <line class="dashed-line" x1="90" y1="0" x2="10" y2="100"></line>
                    </svg>
                </div>
                <div class="fifth circle modal-button" id="fifthModal" data-modal-id="fifthModal">
                    <h4 class="circle__title" value-text="modulosBusiness"></h4>
                </div>
            </div>
        </section>
        <section id="infoModal" class="modal">
            <div id="modalBox" class="modal__box">
                <span class="close" id="closeModalButton">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <div id="modalBodyContent">
                    <h2 class="circle__subtitle" id="modalTitle" value-text=""></h2>
                    <div class="circle__content" id="modalContent" value-text="">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection

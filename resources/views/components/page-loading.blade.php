<div wire:loading.delay>
    <div style="display: flex; justify-content:center; align-items:center; background-color: rgb(26, 2, 240);
    position: fixed; top:0px; left:0px; z-index:999999; width:100%;height:100%; opacity: 0.8;">
      <div class="la-ball-square-spin la-2x">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
</div>

@push('styles')
<style>
/*!
* Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
* Copyright 2015 Daniel Cardoso <@DanielCardoso>
* Licensed under MIT
*/
.la-ball-square-spin,
.la-ball-square-spin > div {
    position: relative;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
.la-ball-square-spin {
    display: block;
    font-size: 0;
    color: #fff;
}
.la-ball-square-spin.la-dark {
    color: #333;
}
.la-ball-square-spin > div {
    display: inline-block;
    float: none;
    background-color: currentColor;
    border: 0 solid currentColor;
}
.la-ball-square-spin {
    width: 26px;
    height: 26px;
}
.la-ball-square-spin > div {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 12px;
    height: 12px;
    margin-top: -6px;
    margin-left: -6px;
    border-radius: 100%;
    -webkit-animation: ball-square-spin 1s infinite ease-in-out;
       -moz-animation: ball-square-spin 1s infinite ease-in-out;
         -o-animation: ball-square-spin 1s infinite ease-in-out;
            animation: ball-square-spin 1s infinite ease-in-out;
}
.la-ball-square-spin > div:nth-child(1) {
    top: 0;
    left: 0;
    -webkit-animation-delay: -1.125s;
       -moz-animation-delay: -1.125s;
         -o-animation-delay: -1.125s;
            animation-delay: -1.125s;
}
.la-ball-square-spin > div:nth-child(2) {
    top: 0;
    left: 50%;
    -webkit-animation-delay: -1.25s;
       -moz-animation-delay: -1.25s;
         -o-animation-delay: -1.25s;
            animation-delay: -1.25s;
}
.la-ball-square-spin > div:nth-child(3) {
    top: 0;
    left: 100%;
    -webkit-animation-delay: -1.375s;
       -moz-animation-delay: -1.375s;
         -o-animation-delay: -1.375s;
            animation-delay: -1.375s;
}
.la-ball-square-spin > div:nth-child(4) {
    top: 50%;
    left: 100%;
    -webkit-animation-delay: -1.5s;
       -moz-animation-delay: -1.5s;
         -o-animation-delay: -1.5s;
            animation-delay: -1.5s;
}
.la-ball-square-spin > div:nth-child(5) {
    top: 100%;
    left: 100%;
    -webkit-animation-delay: -1.625s;
       -moz-animation-delay: -1.625s;
         -o-animation-delay: -1.625s;
            animation-delay: -1.625s;
}
.la-ball-square-spin > div:nth-child(6) {
    top: 100%;
    left: 50%;
    -webkit-animation-delay: -1.75s;
       -moz-animation-delay: -1.75s;
         -o-animation-delay: -1.75s;
            animation-delay: -1.75s;
}
.la-ball-square-spin > div:nth-child(7) {
    top: 100%;
    left: 0;
    -webkit-animation-delay: -1.875s;
       -moz-animation-delay: -1.875s;
         -o-animation-delay: -1.875s;
            animation-delay: -1.875s;
}
.la-ball-square-spin > div:nth-child(8) {
    top: 50%;
    left: 0;
    -webkit-animation-delay: -2s;
       -moz-animation-delay: -2s;
         -o-animation-delay: -2s;
            animation-delay: -2s;
}
.la-ball-square-spin.la-sm {
    width: 12px;
    height: 12px;
}
.la-ball-square-spin.la-sm > div {
    width: 6px;
    height: 6px;
    margin-top: -3px;
    margin-left: -3px;
}
.la-ball-square-spin.la-2x {
    width: 52px;
    height: 52px;
}
.la-ball-square-spin.la-2x > div {
    width: 24px;
    height: 24px;
    margin-top: -12px;
    margin-left: -12px;
}
.la-ball-square-spin.la-3x {
    width: 78px;
    height: 78px;
}
.la-ball-square-spin.la-3x > div {
    width: 36px;
    height: 36px;
    margin-top: -18px;
    margin-left: -18px;
}
/*
 * Animation
 */
@-webkit-keyframes ball-square-spin {
    0%,
    40%,
    100% {
        -webkit-transform: scale(.4);
                transform: scale(.4);
    }
    70% {
        -webkit-transform: scale(1);
                transform: scale(1);
    }
}
@-moz-keyframes ball-square-spin {
    0%,
    40%,
    100% {
        -moz-transform: scale(.4);
             transform: scale(.4);
    }
    70% {
        -moz-transform: scale(1);
             transform: scale(1);
    }
}
@-o-keyframes ball-square-spin {
    0%,
    40%,
    100% {
        -o-transform: scale(.4);
           transform: scale(.4);
    }
    70% {
        -o-transform: scale(1);
           transform: scale(1);
    }
}
@keyframes ball-square-spin {
    0%,
    40%,
    100% {
        -webkit-transform: scale(.4);
           -moz-transform: scale(.4);
             -o-transform: scale(.4);
                transform: scale(.4);
    }
    70% {
        -webkit-transform: scale(1);
           -moz-transform: scale(1);
             -o-transform: scale(1);
                transform: scale(1);
    }
}
</style>
@endpush
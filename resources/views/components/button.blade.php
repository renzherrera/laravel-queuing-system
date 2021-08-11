<button {{$attributes->merge(['class' => 'btn btn-md btn-primary'])}}  style="display: flex; items-center;" >
    <span wire:loading.delay>
      <svg  class="mr-2"  style="margin: auto; background: none; display: block; shape-rendering: auto;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
          <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
          </circle>
      </svg>
     </span>
     {{$slot}}
</button>   
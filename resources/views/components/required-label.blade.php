@props(['for','value'])
<div class="flex items-center">
    <x-jet-label :for="$for" :value="$value" /> <span class="text-red-500 ml-1 mb-2">(*)</span>
</div>

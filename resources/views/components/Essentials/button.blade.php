<button {{$attributes->merge(['class' => 'text-xs uppercase text-center bg-[#4FBD5E] hover:opacity-90 text-white px-10 py-3 rounded-[8px] focus:bg-[#4FBD5E] active:bg-gren-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150'])}}>
    {{$slot}}
</button>
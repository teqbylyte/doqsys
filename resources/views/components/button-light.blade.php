<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-cyan-400 rounded-md font-semibold text-xs text-slate-600 uppercase tracking-widest hover:bg-white/50 active:bg-white/50 focus:outline-none focus:border-white/50 focus:shadow-outline-gray transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border border-slate-200/80 dark:border-slate-800/80 bg-white px-3.5 py-2.5 text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-400']) }}>
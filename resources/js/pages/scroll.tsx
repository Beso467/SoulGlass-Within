import { Head } from '@inertiajs/react';

export default function ScrollPage() {
    return (
        <>
            <Head title="Scroll" />
            <div className="flex flex-1 flex-col px-7 pt-7">
                <div className="text-[11px] tracking-[3px] text-neutral-400">
                    SOULGLASS WITHIN
                </div>
                <h1 className="font-dot mt-6 text-5xl leading-none font-black tracking-[4px]">
                    SCROLL
                </h1>
                <p className="mt-6 text-neutral-400">
                    The quotes you keep will be listed here, with the day each
                    mirror gave them to you.
                </p>
            </div>
        </>
    );
}

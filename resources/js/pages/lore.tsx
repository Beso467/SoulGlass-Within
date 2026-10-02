import { Head } from '@inertiajs/react';

export default function LorePage() {
    return (
        <>
            <Head title="Lore" />
            <div className="flex flex-1 flex-col px-7 pt-7">
                <div className="text-[11px] tracking-[3px] text-neutral-400">
                    SOULGLASS WITHIN
                </div>
                <h1 className="font-dot mt-6 text-5xl leading-none font-black tracking-[4px]">
                    LORE
                </h1>
                <p className="mt-6 text-neutral-400">
                    Nothing has been uncovered yet.
                </p>
            </div>
        </>
    );
}

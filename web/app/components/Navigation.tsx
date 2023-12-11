import {NavRoute} from "@/app/lib/api";


export default function ({routes}: { routes: NavRoute[] }) {
    return <header className="absolute top-0 left-0 right-0 bg-gray-100 h-14">
        <nav className="h-full">
            <ul className="flex justify-center gap-4 sm:gap-16 h-full items-center">
                {routes.map(({href, name}) => {
                    return <li key={href} className="border-b-2 border-black h-full flex items-center">
                        <a href={href}>{name}</a>
                    </li>
                })}
            </ul>
        </nav>
    </header>
}
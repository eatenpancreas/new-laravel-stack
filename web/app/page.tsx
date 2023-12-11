"use client";

import React from "react";
import {Response} from "@/app/lib/responses/response";
import {getApi} from "@/app/lib/request";

export default function Home() {
    const [status, setStatus] = React.useState<Response.Status>(
        {status: "loading", res_type: "status"}
    );
    
    React.useEffect(() => {
        getApi<Response.Status>("/", {}, "status", setStatus).catch((err) => {
            setStatus({status: err.message, res_type: "status"});
        });
    }, []);
    
    return (
        <main className="">
            <h1 className="">Status: {status.status}</h1>
        </main>
    )
}

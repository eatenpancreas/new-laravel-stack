"use client";

import React from "react";
import {StatusResponse} from "@/app/api_interface/response";

export default function Home() {
    const [status, setStatus] = React.useState<StatusResponse>(
        {status: "loading", res_type: "status"}
    );
    
    React.useEffect(() => {
        fetch("http://127.0.0.1:8000/api/").then(
            (res) => res.json()
        ).then((status: StatusResponse) => setStatus(status));
    }, []);
    
    return (
        <main className="">
            <h1 className="">Status: {status.status}</h1>
        </main>
    )
}

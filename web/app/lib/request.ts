import {ThrownError} from "@/app/lib/potential_error";

function stdUrl(uri: string) {
    return "http://127.0.0.1:8000/api" + uri;
}

export function getApi<T>(uri: string, data: object, res_type: string, callback: (data: T) => void) {
    const url = new URL(stdUrl(uri));
    for (const [key, value] of Object.entries(data)) {
        url.searchParams.append(key, value);
    }
    
    const error = new ThrownError();

    fetch(url , {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    }).then((res) => {
        if (!res.ok) {
            throw new Error(res.statusText);
        } return res.json();
    }).then((data: any) => {
        if (res_type == data.res_type) {
            callback(data);
        } else {
            error.error = new Error("Invalid response type");
        }
    }).catch((new_error) => {
        error.error = new_error;
    });
    
    return error;
}

export function postApi<T>(uri: string, data: object, res_type: string, callback: (data: T) => void) {
    const error = new ThrownError();
    
    fetch(stdUrl(uri), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            url: stdUrl(uri), data: data
        })
    }).then((res) => {
        if (!res.ok) {
            throw new Error(res.statusText);
        } return res.json();
    }).then((data: any) => {
        if (res_type == data.res_type) {
            callback(data);
        } else {
            error.error = new Error("Invalid response type");
        }
    }).catch((new_error) => {
        error.error = new_error;
    });

    return error;
}
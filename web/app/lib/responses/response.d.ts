import {type} from "node:os";

namespace Response {
    export type Status = {
        res_type: "status",
        status: string
    }
    
    export interface Success {
        res_type: "success";
        message: string;
    }
}
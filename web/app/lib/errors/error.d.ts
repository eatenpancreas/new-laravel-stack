
namespace Error {
    export type Validation = {
        res_type: "validation_error",
        message: string,
        error: {
            [key: string]: string[]
        }
    }

    export type Head = {
        res_type: "head_error",
        error: string
    }
    
    export type Unauthenticated = {
        res_type: "unauthenticated",
        message: string
    }
}
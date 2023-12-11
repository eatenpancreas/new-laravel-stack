
namespace Request {
    export interface Register {
        username: string,
        email: string,
        password: string,
        confirm_password: string,
    }
    
    export interface Login {
        email: string,
        password: string,
    }
}
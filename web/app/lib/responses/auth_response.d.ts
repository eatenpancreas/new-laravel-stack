
namespace Response {
    export type Authenticated = {
        res_type: 'authenticated',
        message: string,
        token: string
    }

    export type User = {
        res_type: 'user',
        id: number,
        name: string,
        email: string,
        email_verified_at: string,
        created_at: string,
        updated_at: string,
    }
}
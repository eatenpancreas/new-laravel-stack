
export class ThrownError {
    // @ts-ignore
    #callback: any;
    // @ts-ignore
    #mode: "throw" | "log" | "catch" = "throw";
    
    constructor(error?: Error) { this.#call_error_response(error); }
    
    set error(error: Error | undefined) { this.#call_error_response(error); }
    
    // @ts-ignore
    #call_error_response(error: Error | undefined) {
        if (error == undefined) return;
        
        if (this.#mode == "throw") {
            this.throw();
        } else if (this.#mode == "log") {
            console.log(error);
        } else if (this.#mode == "catch") {
            this.#callback(error);
        }
    }
    
    catch(callback: (error: Error) => void) {
        this.#callback = callback;
        this.#mode = "catch";
    }
    
    throw() {
        this.#mode = "throw";
    }
    
    log() {
        this.#mode = "log";
    }
}
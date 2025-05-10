
export async function httpRequest(options){
    // para options, passe um objeto com o method, url, os headers e body
    // espera PUT, DELETE, GET OU POST
    const returnObject = {
            statusCode: 0,
            body: {}
        };

    try {
        const response = await fetch(url, options);

        returnObject.statusCode = response.status;
        
        const contentType = response.headers.get("content-type"); 
        if (contentType && contentType.includes("application/json")) {
           returnObject.body = await response.json();
        }

        return returnObject;

    } catch (err) {
        // Em caso de erro
       returnObject.statusCode = 418;
       return returnObject;
    }
}
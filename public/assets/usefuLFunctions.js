
export async function httpRequest(url, options = null){
    // para options, passe um objeto com o method, os headers, body e etc...
    // espera PUT, DELETE, GET OU POST
    // se GET sem options especificas, não passar options
    const returnObject = {
            statusCode: undefined,
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
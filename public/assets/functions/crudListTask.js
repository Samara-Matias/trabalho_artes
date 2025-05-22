import { httpRequest } from "./usefulFunctions.js";

export async function indexAllLists(containerPaiId){
    elementoPai = document.getElementById(containerPaiId);
    while(elementoPai.firstChild){
        elementoPai.removeChild(elementoPai.firstChild);
    }

    httpRequest()

}
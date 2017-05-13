import { IMethod } from './abstract/interface/IMethod';

export class GraphicMethod implements IMethod {
       
    private static _gamePrice: number;
    
    constructor() { 

        return ; 
    }
    
    static set gamePrice(value: number) { 
    
        this._gamePrice = value; 
        
        return; 
    }
    
    static get gamePrice(): number { 
    
        return this._gamePrice;
    }
    
    static solve(matrix: Array<Array<number>>): Array<number> {
        
        let temp: number = 0,
            length: number = matrix.length,
            result: Array<number> = new Array<number>(),
            tempMatrix: Array<Array<number>> = new Array<Array<number>>();
        
        for(let i: number = 0; i < length; i++) {
            tempMatrix[i] = [matrix[0][i], matrix[1][i] - matrix[0][i]];
        }
        
        length = tempMatrix.length;
        result = [tempMatrix[0][0], tempMatrix[0][1]];
        
        for(let i: number = 0; i < length - 1; i++) {
            result[0] -= tempMatrix[i + 1][0];
            result[1] -= tempMatrix[i + 1][1];
        }
        
        temp = -result[0]/result[1];
        result = [ 1 - temp, temp, tempMatrix[0][0] + tempMatrix[0][1]*temp];
                
        return result; 
    }

}
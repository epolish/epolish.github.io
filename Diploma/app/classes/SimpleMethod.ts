import { MatrixOperationAbstract } from './abstract/MatrixOperationAbstract';
import { IMethod } from './abstract/interface/IMethod';

export class SimpleMethod extends MatrixOperationAbstract implements IMethod {
       
    private static _gamePrice: number;
    
    constructor() { 
    
        SimpleMethod._gamePrice = null;
        super();
        
        return ; 
    }
    
    static set gamePrice(value: number) { 
    
        this._gamePrice = value; 
        
        return; 
    }
    
    static get gamePrice(): number { 
    
        return this._gamePrice;
    }
    
    static solve(matrix: Array<Array<number>>): number {
        
        let maxA: Array<number> = [],
            maxB: Array<number> = [],
            length: number = matrix.length;
        
        for (let i: number = 0; i < length; maxA.push(this.getMin(matrix[i++])));
        matrix = this.transposeMatrix(matrix);
        for (let i: number = 0; i < length; maxB.push(this.getMax(matrix[i++])));
        maxB.reverse();
        
        this._gamePrice = maxA.filter((value: number, index: number) => 
            value === maxB[index] && value !== undefined && maxB[index] !== undefined
        )[0];
        
        return this._gamePrice;
    }
    
}
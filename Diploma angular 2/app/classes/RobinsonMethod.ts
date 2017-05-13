import { SimpleMethod } from './SimpleMethod';
import { IMethod } from './abstract/interface/IMethod';

export class RobinsonMethod implements IMethod {

    private static _gamePrice: number;
    public static START_STRATEGY: number = 0;
    public static COUNT_ITERATIONS: number = 20;
    
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
    
    static solve(matrix: Array<Array<number>>): Array<Array<number>> {

        let mixedStrategyPlayerA:Array<number> = Array<number>(),
            mixedStrategyPlayerB:Array<number> = Array<number>(),
            countStrategyPlayerA: number = matrix.length,
            countStrategyPlayerB: number = matrix[0].length,
            data = SimpleMethod.transposeMatrix(this.iterate(matrix)),
            dataLength: number = data[0].length;
            
        for (let i: number = 1; i <= countStrategyPlayerA; i++) {
            mixedStrategyPlayerA.push(data[0].filter(value => value === i).length/dataLength);
        }
        
        for (let i: number = 1; i <= countStrategyPlayerB; i++) {
            mixedStrategyPlayerB.push(data[1].filter(value => value === i).length/dataLength);
        }

        return [mixedStrategyPlayerA, mixedStrategyPlayerB];
    }
    
    private static iterate(matrix: Array<Array<number>>): Array<Array<number>> {

        let strategyA: number = this.START_STRATEGY,
            row: Array<number> = matrix[strategyA],
            strategyB: number = row.indexOf(SimpleMethod.getMin(row)),
            column: Array<number> = SimpleMethod.getMatrixColumn(matrix, strategyB),
            data: Array<Array<number>> = new Array<Array<number>>();
        
        for(let i: number = 1; i <= this.COUNT_ITERATIONS; i++) {
            if (i === this.COUNT_ITERATIONS) {
                this.gamePrice  = (SimpleMethod.getMin(row)/i + SimpleMethod.getMax(column)/i)/2; 
            }
            data.push([strategyA + 1, strategyB + 1]);
            strategyA = column.indexOf(SimpleMethod.getMax(column));
            row = matrix[strategyA].map((value, index) => value += row[index]);
            strategyB = row.indexOf(SimpleMethod.getMin(row));
            column = SimpleMethod.getMatrixColumn(matrix, strategyB)
                             .map((value, index) => value += column[index]);
        }

        return data;
    }
    
}
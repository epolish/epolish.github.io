export abstract class MatrixOperationAbstract {
       
    private static _MATRIX_MODIFIED: boolean = true;
    private static _MATRIX_MODIFIED_GLOBAL: boolean = false;
    
    constructor() { 
    
        return ; 
    }
    
    static getMax(array: Array<number>): number { 
        
        return Math.max.apply(null, array); 
    }
    
    static getMin(array: Array<number>): number { 
    
        return Math.min.apply(null, array);
    }
 
    static getMatrixColumn(matrix: Array<Array<number>>, position: number): Array<number> {
        
        return matrix.map((value, index) => value[position]);
    }
    
    static transposeMatrix(matrix: Array<Array<number>>): Array<Array<number>> {
        
        return matrix[0].map((value: number, index: number) => 
            matrix.map((row: Array<number>) => row[index])
        );
    }
    
    static sortRowByColumn(first: Array<number>, second: Array<number>): number {
        
        if (first[0] === second[0]) {
            
            return 0;
        } else {
        
            return first[0] < second[0] ? -1 : 1;
        }
    }
    
    static sortMatrix(matrix: Array<Array<number>>, playerA: boolean = true): Array<Array<number>> {
        
        let summArray: Array<number> = new Array<number>();
        
        matrix.map((value, index) => summArray.push(matrix[index].reduce((a: number, b: number) => a + b)));
        matrix.map((value, index, array) => array[index].unshift(summArray[index]));
        matrix.sort(MatrixOperationAbstract.sortRowByColumn);
        matrix.map(value => value.shift());
        
        return playerA ? matrix : matrix.reverse();
    }
    
    static compactRow(matrix: Array<Array<number>>, playerA: boolean = true): Array<Array<number>> {
        
        MatrixOperationAbstract._MATRIX_MODIFIED = false;
        let length: number = matrix.length,
            operation: Function = new Function('a', 'b', 'return a ' + (playerA ? '<' : '>') + '= b;');

        for(let i: number = 0; i < length; i++) {
            for(let j: number = i + 1; j < length; j++) {
                let lessOrEqual: number = matrix[i].filter(
                    (value, index) => operation(value, matrix[j][index])
                ).length;
                if (lessOrEqual  === matrix[i].length) {
                    MatrixOperationAbstract._MATRIX_MODIFIED = true;
                    MatrixOperationAbstract._MATRIX_MODIFIED_GLOBAL = true;
                    matrix.splice(i, 1);
                    return matrix;
                }
            }
        }
        
        return matrix;
    }
    
    static compactMatrix(matrix: Array<Array<number>>): Array<Array<number>> {

        while (MatrixOperationAbstract._MATRIX_MODIFIED) {
            matrix = MatrixOperationAbstract.sortMatrix(matrix);
            MatrixOperationAbstract.compactRow(matrix);
        }
        
        matrix = MatrixOperationAbstract.transposeMatrix(matrix);
        MatrixOperationAbstract._MATRIX_MODIFIED = true;
        MatrixOperationAbstract._MATRIX_MODIFIED_GLOBAL = false;
        
        while (MatrixOperationAbstract._MATRIX_MODIFIED) {
            matrix = MatrixOperationAbstract.sortMatrix(matrix, false);
            MatrixOperationAbstract.compactRow(matrix, false);
        }
        
        matrix = MatrixOperationAbstract.transposeMatrix(matrix);
        
        if(!MatrixOperationAbstract._MATRIX_MODIFIED_GLOBAL && MatrixOperationAbstract._MATRIX_MODIFIED) {
            MatrixOperationAbstract.compactMatrix(matrix);
        }

        return matrix;
    }
    
}
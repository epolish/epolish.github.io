/// Composite + Factory Method
using System;
using System.Collections;

namespace Figures
{
    abstract class Figure
    {
        public string Name { get; set; }

        public string Color { get; set; }

        public void Draw()
        {
            Console.WriteLine("I’m {0} of Color {1} .", Name, Color);
        }
    }

    class Triangle : Figure { }

    class Square : Figure { }

    class Circle : Figure { }

    abstract class Creator
    {
        public abstract Figure FactoryMethod();
    }

    class CircleCreator : Creator
    {
        public override Figure FactoryMethod()
        {
            return new Circle();
        }
    }

    class SquareCreator : Creator
    {
        public override Figure FactoryMethod()
        {
            return new Square();
        }
    }

    class TriangleCreator : Creator
    {
        public override Figure FactoryMethod()
        {
            return new Triangle();
        }
    }

    abstract class FigureComponent : Figure
    {
        public FigureComponent(Figure figure)
        {
            if (figure.Name == null || figure.Color == null)
            {
                throw new Exception("Fields Name and Color are required.");
            }
            else
            {
                this.Name = figure.Name;
                this.Color = figure.Color;
            }
        }

        public abstract void DrawAll();

        public abstract void Add(FigureComponent component);

        public abstract void Remove(FigureComponent component);

        public abstract FigureComponent GetChild(int index);
    }

    class Box : FigureComponent
    {
        ArrayList nodes = new ArrayList();

        public Box(Figure figure) : base(figure) { }

        public override void DrawAll()
        {
            Console.WriteLine("I’m {0} of Color {1} .", Name, Color);

            foreach (FigureComponent component in nodes)
            {
                component.DrawAll();
            }
        }

        public override void Add(FigureComponent component)
        {
            nodes.Add(component);
        }

        public override void Remove(FigureComponent component)
        {
            nodes.Remove(component);
        }

        public override FigureComponent GetChild(int index)
        {
            return nodes[index] as FigureComponent;
        }
    }

    class FigurePart : FigureComponent
    {
        public FigurePart(Figure figure) : base(figure) { }

        public override void DrawAll()
        {
            Console.WriteLine("I’m {0} of Color {1} .", Name, Color);
        }

        public override void Add(FigureComponent component)
        {
            throw new InvalidOperationException();
        }

        public override void Remove(FigureComponent component)
        {
            throw new InvalidOperationException();
        }

        public override FigureComponent GetChild(int index)
        {
            throw new InvalidOperationException();
        }
    }

    class Program
    {
        static void Main(string[] args)
        {
            Figure figure = new CircleCreator().FactoryMethod();
            figure.Name = "Circle";
            figure.Color = "red";
            FigureComponent root = new Box(figure);

            figure = new TriangleCreator().FactoryMethod();
            figure.Name = "Triangle";
            figure.Color = "green";
            FigureComponent branchFirst = new Box(figure);

            figure = new SquareCreator().FactoryMethod();
            figure.Name = "Square";
            figure.Color = "green";
            FigureComponent branchSecond = new Box(figure);

            figure = new SquareCreator().FactoryMethod();
            figure.Name = "Square";
            figure.Color = "pink";
            FigureComponent leafFirst = new FigurePart(figure);

            figure = new TriangleCreator().FactoryMethod();
            figure.Name = "Triangle";
            figure.Color = "blue";
            FigureComponent leafSecond = new FigurePart(figure);

            root.Add(branchFirst);
            root.Add(branchSecond);
            branchFirst.Add(leafFirst);
            branchSecond.Add(leafSecond);
            root.DrawAll();

            Console.ReadKey();
        }
    }
}
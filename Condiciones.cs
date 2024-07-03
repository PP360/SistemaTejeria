/*
Escribe un programa que responda a un usuario que quiere comprar un helado en Mc donalds 
cuanto le costará en función del topping que elija.

El helado sin topping cuesta $19 .
El topping de oreo cuesta $5.
El topping de KitKat cuesta $7.50.
El topping de brownie cuesta $8.5.
El topping de lacasitos cuesta $9.5.
En caso de no disponer del topping solicitado por el usuario el programa escribirá por pantalla 
«no tenemos este topping, lo sentimos. » 
y a continuación informar del precio del helado sin ningún topping.
 */
using System;

namespace JoseValenciaCruz10
{
	class Program
	{
		public static void Main(string[] args)
		{
			int topping=0;
			Console.WriteLine("Menú de Toppings de Helados de MC Donalds");
			Console.WriteLine("1.- Oreo");
			Console.WriteLine("2.- Kitkat");
			Console.WriteLine("3.- Brownie");
			Console.WriteLine("4.- Lacasitos");
			Console.WriteLine("0.- Sin topping");
			Console.WriteLine("Seleccione el topping del helado: ");
			topping=int.Parse(Console.ReadLine());
			if (topping==1)
			{
				Console.WriteLine("El precio del helado con topping de Oreo es de $24.00");
			}
			else if (topping==2)
			{
				Console.WriteLine("El precio del helado con topping de Kitkat es de $26.50");
			}
			else if (topping==3)
			{
				Console.WriteLine("El precio del helado con topping de Brownie es de $27.50");
			}
			else if (topping==4)
			{
				Console.WriteLine("El precio del helado con topping de Lacasitos es de $28.50");
			}
			else if (topping==0)
			{
				Console.WriteLine("El precio del helado Sin topping es de $19.00");
			}
			else
			{
				Console.WriteLine("no tenemos este topping, lo sentimos.");
			}
			
			
			Console.Write("Press any key to continue . . . ");
			Console.ReadKey(true);
		}
	}
}
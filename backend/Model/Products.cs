using System;
using System.Collections.Generic;

namespace backend.Model
{
  public class Products
  {
    public int id { get; set; }
    public string name { get; set; }
    public double price { get; set; }
    public string sizes { get; set; }
    public string description { get; set; }
    public string available { get; set; }
    public string category { get; set; }
    public string gender { get; set; }
    public string image => $"https://api.reeqzan.com/Products/GetImage?id={id}";
  }

  public class ProductGrouping
  {
    public string group { get; set; }
    public List<Products> products { get; set; }
  }
}
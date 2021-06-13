using System;
using System.Collections.Generic;

namespace backend.Model
{
  public class Orders
  {
    public int id { get; set; }
    public string userid { get; set; }
    public string name { get; set; }
    public string orderid { get; set; }
    public int quantity { get; set; }
    public string size { get; set; }
    public double price { get; set; }
    public DateTime orderat { get; set; }
  }

  public class History
  {
    public string orderid { get; set; }
    public double price { get; set; }
    public DateTime orderat { get; set; }
    public List<Orders> orders { get; set; }
  }
}
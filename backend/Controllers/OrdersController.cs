using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json;
using System.Threading.Tasks;
using backend.MySQL;
using backend.Extensions;
using backend.Model;
using Microsoft.AspNetCore.Mvc;

namespace backend.Controllers
{
  [ApiController]
  [Route("Orders/[action]")]
  public class OrdersController : Controller
  {
    MySqlConnect connect = new MySqlConnect();

    [HttpPost]
    public async Task<bool> CreateOrder([FromBody]JsonElement model)
    {
      var allOrders = model.ToObject<List<Orders>>();

      var values = new List<string>();
      foreach (var o in allOrders)
        values.Add($"('NULL', '{o.userid}', '{o.name}', '{o.orderid}', '{o.quantity}', '{o.size}', '{o.price}', '{o.orderat.ToString("yyyy-MM-dd HH:mm:ss")}')");
      
      try {
        return await connect.ExecuteNonQuery($"INSERT INTO orders VALUES {string.Join(", ", values)}");
      }
      catch (Exception ex)
      {
        System.Console.WriteLine(ex.Message);
        return false;
      }
    }

    [HttpGet]
    public async Task<List<History>> History(string userid)
    {
      var orders = await connect.Execute($"SELECT * FROM orders WHERE userid = '{userid}'");
      
      var ordersList = new List<Orders>();
      foreach (var h in orders)
        ordersList.Add(h.ToObject<Orders>());
      var ordersGrouped = ordersList.GroupBy(o => o.orderid);
      
      var historyList = new List<History>();
      foreach (var g in ordersGrouped)
        historyList.Add(new History { orderid = g.Key, orderat = g.ToList()[0].orderat, price = g.ToList()[0].price, orders = g.ToList() });

      return historyList;
    }
  }
}
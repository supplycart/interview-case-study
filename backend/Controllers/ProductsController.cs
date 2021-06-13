using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Net.Mail;
using System.Text.Json;
using System.Threading.Tasks;
using backend.MySQL;
using backend.Extensions;
using backend.Model;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;

namespace backend.Controllers
{
  [ApiController]
  [Route("Products/[action]")]
  public class ProductsController : Controller
  {
    MySqlConnect connect = new MySqlConnect();

    [HttpGet]
    public async Task<IActionResult> GetImage(string id)
    {
      try
      {
        var fromDB = await connect.Execute($"SELECT image FROM products WHERE id = '{id}'");
        var imgByte = (byte[])fromDB[0]["image"];
        return File(imgByte, "image/jpeg");
      }
      catch (Exception ex)
      {
        System.Console.WriteLine(ex.StackTrace);
        return null;
      }
    }

    [HttpGet]
    public async Task<List<ProductGrouping>> GetProducts()
    {
      var allProducts = await connect.Execute("SELECT id, name, price, sizes, description, available, category, gender FROM products");
      var products = new List<Products>();
      foreach (var p in allProducts)
        products.Add(p.ToObject<Products>());

      var result = new List<ProductGrouping>();
      var grouped = products.GroupBy((p) => p.category);
      foreach (var g in grouped)
        result.Add(new ProductGrouping { group = g.Key, products = g.ToList() });

      return result;
    }
  }
}
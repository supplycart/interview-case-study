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
  [Route("Activity/[action]")]
  public class ActivityController : Controller
  {
    MySqlConnect connect = new MySqlConnect();

    [HttpPost]
    public async Task<bool> Add([FromBody]JsonElement model)
    {
      var details = model.ToObject<Activity>();
      return await connect.ExecuteNonQuery($"INSERT INTO activity (id, userid, datetime, activity) VALUES (NULL, '{details.userid}', '{details.datetime.ToString("yyyy-MM-dd HH:mm:ss")}', '{details.activity}')");
    }

    [HttpGet]
    public async Task<List<Activity>> Get(string id)
    {
      var details = await connect.Execute($"SELECT * FROM activity WHERE userid = '{id}' ORDER BY datetime DESC");
      
      var result = new List<Activity>();
      foreach (var d in details)
        result.Add(d.ToObject<Activity>());

      return result;
    }
  }
}
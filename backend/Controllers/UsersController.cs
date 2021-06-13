using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using backend.Extensions;
using backend.MySQL;
using backend.Model;

namespace backend.Controllers
{
  [ApiController]
  [Route("Users/[action]")]
  public class UsersController : Controller
  {
    MySqlConnect connect = new MySqlConnect();

    [HttpPost]
    public async Task<UserDetails> Login([FromBody]JsonElement model)
    {
      var details = model.ToObject<UserLogin>();

      var login = await connect.Execute($"SELECT * from users WHERE userid = '{details.userID}' AND password = '{details.password}'");
      if (login.Count > 0)
      {
        var loginKey = Guid.NewGuid().ToString();

        var result = login[0].ToObject<UserDetails>();
        result.password = null;
        result.loginkey = loginKey;

        await connect.ExecuteNonQuery($"UPDATE users SET loginkey = '{result.loginkey}' WHERE id = '{result.id}'");

        return result;
      }
      else
        return null;
    }

    [HttpPost]
    public async Task<bool> Register([FromBody]JsonElement model)
    {
      var code = new Random().Next(1000, 9999);
      var details = model.ToObject<UserDetails>();
      var register = await connect.ExecuteNonQuery($"INSERT INTO users (id, userid, email, fullname, usertype, password, loginkey, verifycode) VALUES (NULL, '{details.userID}', '{details.email}', '{details.fullName}', '{details.userType}', '{details.password}', '{details.loginkey}', '{code}')");

      if (register)
      {
        var user = await connect.Execute($"SELECT * FROM users WHERE userid = '{details.userID}'");
        var userObject = user[0].ToObject<UserDetails>();
        var body = $"<div style=\"display: flex; flex-direction: column; width: 100%; padding: 10px; align-items: center\">";
        body += $"<h1 style=\"margin: 0\">Hey {details.fullName}!</h1><br>";
        body += $"<h2 style=\"margin-top: 0\">Thank you for registering.</h2><br>";
        body += $"<div>";
        body += $"Please verify your email address at ";
        // body += $"<a style=\"text-decoration: underline; color: blue\" href=\"http://localhost:8080/Verify/{userObject.id}\">http://localhost:8080/Verify/{userObject.id}</a>";
        body += $"<a style=\"text-decoration: underline; color: blue\" href=\"https://supplycart.reeqzan.com/Verify/{userObject.id}\">https://supplycartcasestudy.reeqzan.com/Verify/{userObject.id}</a>";
        body += $"</div><br>";
        body += $"<div>Your Verification Code is</div>";
        body += $"<h2 style=\"margin-top: 0px\">{code}</h2>";
        body += $"</div>";
        
        new Mailer().SendEmail(details.email, "Email Verification", body);
        return true;
      }
      else 
        return false;
    }

    [HttpGet]
    public async Task<UserDetails> GetUser(string id, bool showCode = false)
    {
      var user = await connect.Execute($"SELECT * FROM users WHERE id = '{id}'");
      if (user.Count > 0)
      {
        var result = user[0].ToObject<UserDetails>();
        if (result.verifycode == null)
          return null;

        if (!showCode)
          result.verifycode = null;

        return result;
      }
      else 
        return null;
    }

    [HttpGet]
    public async Task<bool> Verify(string id, int code)
    {
      var user = await GetUser(id, true);

      if (code == user.verifycode.Value)
        return await connect.ExecuteNonQuery($"UPDATE users SET verifycode = NULL WHERE id = {id}");
      else
        return false;
    }

    [HttpGet]
    public async Task<bool> CheckUserIDAvailability(string uid)
    {
      var result = await connect.Execute($"SELECT * FROM users WHERE userid = '{uid}'");
      return result.Count == 0;
    }
  }
}
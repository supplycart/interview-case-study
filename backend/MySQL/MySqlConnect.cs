using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using MySql.Data.MySqlClient;
using Newtonsoft.Json;

namespace backend.MySQL
{
  public class MySqlConnect
  {
    private MySqlConnection con = null;
    private readonly static string ConnectionString = "server=localhost;port=3366;user=USERNAME;password=PASSWORD;database=DATABASENAME";
    
    public MySqlConnection GetConnection
    {
      get
      {
        if (con == null)
        {
          con = new MySqlConnection(ConnectionString);
          return con;
        }
        else
          return con;
      }
    }

    public async Task<List<Dictionary<string, object>>> Execute(string query)
    {
      var con = GetConnection;
      await con.OpenAsync();

      var command = new MySqlCommand(query, con);
      var cmd = await command.ExecuteReaderAsync();
      var result = new List<Dictionary<string, object>>();

      while (await cmd.ReadAsync())
      {
        var count = cmd.FieldCount;
        var row = new Dictionary<string, object>();

        for (var i = 0; i < count; i++) 
          row.Add(cmd.GetName(i), cmd.IsDBNull(i) ? "" : cmd.GetValue(i));

        result.Add(row);
      }

      await con.CloseAsync();

      return result;
    }
  
    public async Task<bool> ExecuteNonQuery(string query)
    {
      var con = GetConnection;
      await con.OpenAsync();

      var command = new MySqlCommand(query, con);
      var cmd = await command.ExecuteNonQueryAsync();

      await con.CloseAsync();
      return cmd > 0;
    }
  }
}
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.Json;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;

namespace backend.Extensions
{
  public static class Extensions
  {
    public static T ToObject<T>(this JsonElement item)
    {
      try
      {
        return JsonConvert.DeserializeObject<T>(item.GetRawText());
      }
      catch
      {
        return default(T);
      }
    }

    public static T ToObject<T>(this Dictionary<string, object> item)
    {
      try
      {
        var str = JsonConvert.SerializeObject(item);
        return JsonConvert.DeserializeObject<T>(str);
      }
      catch
      {
        return default(T);
      }
    }
  }
}
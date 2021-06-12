using System;

namespace backend.Model
{
  public class Activity
  {
    public int id { get; set; }
    public string userid { get; set; }
    public DateTime datetime { get; set; }
    public string activity { get; set; }
  }
}
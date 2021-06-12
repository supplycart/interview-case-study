using System;

namespace backend.Model
{
  public class UserDetails
  {
    public int id { get; set; }
    public string userID { get; set; }
    public string email { get; set; }
    public string fullName { get; set; }
    public string userType { get; set; }
    public string password { get; set; }
    public string loginkey { get; set; }
    public Nullable<int> verifycode { get; set; }
  }

  public class UserLogin
  {
    public string userID { get; set; }
    public string password { get; set; }
  }
}
namespace Backend.Models
{
    public class User
    {
        public string Id { get; set; }
        public string Name { get; set; }
        public string Email { get; set; }
    }

    public class UserDto
    {
        public string Name { get; set; }
        public string Email { get; set; }
    }
}
using Microsoft.AspNetCore.Mvc;
using Backend.Data;
using Backend.Models;
using Microsoft.EntityFrameworkCore;
using System.Threading.Tasks;
using System.Collections.Generic;

[ApiController]
[Route("api/[controller]")]
public class UsersController : ControllerBase
{
    private readonly AppDbContext _context;
    private readonly GenericIdGenerator<User> _idGenerator;

    public UsersController(AppDbContext context, GenericIdGenerator<User> idGenerator)
    {
        _context = context;
        _idGenerator = idGenerator;
    }

    // POST: Create a new user
    [HttpPost]
    public async Task<IActionResult> Create([FromBody] User user)
    {
        if (user == null)
            return BadRequest("User data is required.");

        user.Id = await _idGenerator.GenerateIdAsync();

        _context.Users.Add(user);
        await _context.SaveChangesAsync();

        return CreatedAtAction(nameof(ReadId), new { id = user.Id }, user);
    }

    // PUT: Update an existing user
    [HttpPut("{id}")]
    public async Task<IActionResult> Update(string id, [FromBody] User userUpdate)
    {
        var user = await _context.Users.FindAsync(id);
        if (user == null)
            return NotFound("User not found.");

        user.Name = userUpdate.Name;
        user.Email = userUpdate.Email;

        _context.Users.Update(user);
        await _context.SaveChangesAsync();

        return Ok(user);
    }

    // GET: Read all users
    [HttpGet]
    public async Task<ActionResult<IEnumerable<User>>> Read()
    {
        var users = await _context.Users.ToListAsync();
        return Ok(users);
    }

    // GET: Read one user by ID
    [HttpGet("{id}")]
    public async Task<IActionResult> ReadId(string id)
    {
        var user = await _context.Users.FindAsync(id);
        if (user == null)
            return NotFound("User not found.");

        return Ok(user);
    }

    // DELETE: Delete one user by ID
    [HttpDelete("{id}")]
    public async Task<IActionResult> Delete(string id)
    {
        var user = await _context.Users.FindAsync(id);
        if (user == null)
            return NotFound("User not found.");

        _context.Users.Remove(user);
        await _context.SaveChangesAsync();

        return NoContent();
    }
}
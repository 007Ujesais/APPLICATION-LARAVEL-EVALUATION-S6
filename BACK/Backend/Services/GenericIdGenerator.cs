using Backend.Data;
using Microsoft.EntityFrameworkCore;

public class GenericIdGenerator<T> where T : class
{
    private readonly AppDbContext _context;
    
    public GenericIdGenerator(AppDbContext context)
    {
        _context = context;
    }

    public async Task<string> GenerateIdAsync()
    {
        var prefix = typeof(T).Name.Substring(0, 3).ToUpper();

        // Récupérer le dernier ID existant qui commence par le préfixe attendu
        var lastEntity = await _context.Set<T>()
            .AsQueryable()
            .Where(e => EF.Property<string>(e, "Id").StartsWith(prefix))
            .OrderByDescending(e => EF.Property<string>(e, "Id"))
            .FirstOrDefaultAsync();

        if (lastEntity == null)
        {
            return $"{prefix}001";
        }

        var lastId = (lastEntity as dynamic)?.Id as string;

        if (string.IsNullOrEmpty(lastId) || lastId.Length <= 3)
        {
            throw new InvalidOperationException("L'ID du dernier élément est invalide.");
        }

        // Vérifier que l'ID se termine bien par un nombre
        if (!int.TryParse(lastId.Substring(3), out int lastIdNumber))
        {
            throw new FormatException("Le format de l'ID est incorrect.");
        }

        var newIdNumber = lastIdNumber + 1;

        return $"{prefix}{newIdNumber:D3}";
    }
}
